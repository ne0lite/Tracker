<?php

use Rych\Bencode\Bencode;

class AnnounceController extends BaseController
{
    public function announce($tid, $uid)
    {
        // torrent klients (utorrent) atver šādu adresi
        // http://xxx/announce/2/2?info_hash=xxxx&peer_id=xxxx&numwant=50&event=started&port=123&left=0
        // parametru skaidrojums
        // https://wiki.theory.org/BitTorrentSpecification (Tracker Request Parameters)
        $torrent = Torrent::findOrFail($tid);
        $user = User::findOrFail($uid);

        Eloquent::unguard();
        // atlasa ierakstu vai izveido jaunu
        $data = TorrentUser::firstOrCreate(array('torrent_id' => $torrent->id, 'user_id' => $user->id));
        $data->ip = $_SERVER['REMOTE_ADDR']; // utorrent ip adrese
        $data->port = (int)@$_GET['port']; // utorrent ports
        $data->peer_id = @$_GET['peer_id']; // utorrent kaut kāds id
        $data->seeding = @$_GET['left'] == 0; // cik baiti atlikuši lejuplādēt (0 = pabeigts)

        if (@$_GET['event'] == 'stopped') {
            $data->delete(); // nospieda stop pogu, dzēšam
        } else {
            $data->save();
        }

        $numwant = isset($_GET['numwant']) ? (int)$_GET['numwant'] : 50; // cik datus par citiem lietotājiem grib

        $complete = TorrentUser::where('torrent_id', $torrent->id)->where('seeding', true)->count(); // saskaita šim torrentam seederus
        $incomplete = TorrentUser::where('torrent_id', $torrent->id)->where('seeding', false)->count(); // saskaita šim torrentam leecherus
        $peers = TorrentUser::where('torrent_id', $torrent->id)->select('peer_id', 'ip', 'port')->take($numwant)->get()->toArray();

        // https://wiki.theory.org/BitTorrentSpecification (Tracker Response)
        $response = array(
            'interval' => 60,
            'tracker id' => 'tracker',
            'complete' => $complete,
            'incomplete' => $incomplete,
            'peers' => $peers
        );

        $response = Response::make(Bencode::encode($response), 200);
        $response->header('Content-Type', 'text/plain');
        return $response;
    }
}