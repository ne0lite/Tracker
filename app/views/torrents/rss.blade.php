<?xml version="1.0" encoding="utf-8" ?>
<rss version="2.0">
  <channel>
    <title>Tracker</title>
    <description>Torrent Tracker Latest Torrents</description>
    <link>{{{ url('/') }}}</link>
    <lastBuildDate>{{{ date('c') }}}</lastBuildDate>
    <pubDate>{{{ date('c') }}}</pubDate>
    <ttl>1800</ttl>
    @foreach ($torrents as $torrent)
    <item>
      <title>{{{ $torrent->name  }}}</title>
      <description>{{{ $torrent->name  }}}</description>
      <link>{{{ url('torrents', $torrent->id) }}}</link>
      <guid>{{{ $torrent->id }}}</guid>
      <pubDate>{{{ $torrent->created_at->format('c') }}}</pubDate>
    </item>
    @endforeach
</channel>
</rss>