<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
    <channel>
        <title>altGaming Podcast</title>
        <link>{{ url('/') . "/podcast" }}</link>
        <description>altGaming | Videos, words and thoughts about gaming</description>
        <language>en-us</language>
        <pubDate>{{ now() }}</pubDate>
        @foreach($podcasts as $podcast)
            <item>
                <title>{{ $podcast->title }}</title>
                <enclosure url="{{ asset("storage/" . $podcast->audio_file) }}" type="audio/mp3" length="{{ \Storage::size($podcast->audio_file) }}"/>
                <description>{{ $podcast->description }}</description>
                <category>Gaming</category>
                <author>{{ $podcast->user->username }}</author>
                <pubDate>{{ $podcast->created_at->toRssString() }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>
