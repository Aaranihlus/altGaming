<xml version="1.0" encoding="UTF-8">
<rss version="2.0">
    <channel>
        <title><![CDATA[ altGaming Podcast ]]></title>
        <link><![CDATA[ {{ url('/') }}/feed ]]></link>
        <description><![CDATA[ altGaming | Videos, words and thoughts about gaming ]]></description>
        <language>en</language>
        <pubDate>{{ now() }}</pubDate>

        @foreach($podcasts as $podcast)
            <item>
                <title><![CDATA[{{ $podcast->title }}]]></title>
                <link>{{ url('/') . "/podcast/" . $podcast->slug }}</link>
                <description><![CDATA[{{ $podcast->description }}]]></description>
                <category>Gaming</category>
                <author><![CDATA[{{ $podcast->user->username  }}]]></author>
                <guid>{{ $podcast->id }}</guid>
                <pubDate>{{ $podcast->created_at->toRssString() }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>
</xml>
