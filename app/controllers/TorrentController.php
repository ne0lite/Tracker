<?php
use Rych\Bencode\Bencode;

class TorrentController extends BaseController
{
    public function getTorrents($category = null)
    {
        $categories = Category::all();

        $torrents = Torrent::with('category')->orderBy('created_at', 'desc');

        if ($category) {
            $category = Category::where('name', '=', $category)->first();
            if ($category) {
                $torrents = $torrents->where('category_id', $category->id);
            }
        }

        $search = null;
        if (isset($_GET['text'])) {
            $search = $_GET['text'];
            $torrents = $torrents->where('name', 'LIKE', '%'.$search.'%');
        }

        return View::make('torrents/torrents', array(
            'torrents' => $torrents->get(),
            'categories' => $categories,
            'category' => $category,
            'search' => $search
        ));
    }

    public function getDetails($id)
    {
        $torrent = Torrent::find($id);

        if (!$torrent) {
            App::abort(404);
        }

        return View::make('torrents/selected',array('torrent'=>$torrent));
    }

    public function getUpload()
    {
        if (Auth::check())
        {
            $categories = array();
            foreach (Category::all() as $category) {
                $categories[$category->id] = $category->name;
            }
            return View::make('torrents/upload', array('categories'=>$categories));
        }
        return Redirect::to('login')->with('alert', 'Please log in to upload a new torrent!');
    }

    public function postUpload()
    {
        $data = Input::all();

        $rules = array(
            'category' => 'required',
        );

        // todo: validate category
        // todo: validate file size

        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {
            if (Input::hasFile('file')) {

                $contents = file_get_contents(Input::file('file')->getRealPath());
                $decoded = Bencode::decode($contents);
                $decoded['announce'] = Config::get('app.url') . '/announce';
                unset($decoded['announce-list']);
                $contents = Bencode::encode($decoded);

                $torrent = new Torrent;
                $torrent->name = $decoded['info']['name'];
                $torrent->size = 0;
                $torrent->downloads = 0;
                $torrent->file = $contents;
                $torrent->category_id = $data['category'];
                $torrent->uploader_id = Auth::user()->id;
                $torrent->save();

                $files = array();
                if(!empty($decoded['info']['files'])){
                    foreach ($decoded['info']['files'] as $file) {
                        $files[] = array(
                            'torrent_id' => $torrent->id,
                            'name' => implode('/', $file['path']),
                            'size' => $file['length']
                        );
                        $torrent->size += $file['length'];
                    }
                }
                else
                {
                    $files[] = array(
                        'torrent_id' => $torrent->id,
                        'name' => $decoded['info']['name'],
                        'size' => $decoded['info']['length']
                    );
                    $torrent->size += $decoded['info']['length'];
                }

                //http://stackoverflow.com/questions/12702812/bulk-insertion-in-laravel-using-eloquent-orm
                TorrentFile::insert($files);
                $torrent->save();

                return Redirect::action('TorrentController@getDetails', array($torrent->id))->with('success', 'Your torrent has been added!');
            }
        }
        return Redirect::to('/upload')->withInput()->withErrors($validator);
    }

    public function getDownload($id)
    {
        $torrent = Torrent::find($id);

        if (!$torrent) {
            App::abort(404);
        }
        $torrent->downloads += 1;
        $torrent->save();

        $response = Response::make($torrent->file, 200);
        $response->header('Content-Type', 'application/x-bittorrent'); // http://x-bittorrent.mime-application.com/
        $response->header('Content-Disposition', 'attachment; filename='.$torrent->name.'.torrent'); // http://stackoverflow.com/questions/93551/how-to-encode-the-filename-parameter-of-content-disposition-header-in-http
        return $response;
    }


    public function deleteTorrent($id)
    {

        TorrentFile::where('torrent_id', '=', $id)->delete();
        Torrent::where('id', '=', $id)->delete();
        return Redirect::to('/')->with('success', 'Torrent deleted.');
    }
}