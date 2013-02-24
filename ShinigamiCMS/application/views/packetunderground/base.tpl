<html>
    <head>
        <title>{block name=title}Packet Underground -- Scattered Ramblings{/block}</title>
        <link rel="stylesheet" href="/resources/css/blueprint/screen.css" type="text/css" media="screen, projection">
        <link rel="stylesheet" href="/resources/css/blueprint/print.css" type="text/css" media="print"> 
        <!--[if lt IE 8]>
          <link rel="stylesheet" href="resources/css/blueprint/ie.css" type="text/css" media="screen, projection">
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="/resources/css/main.css" media="screen, projection" />
        {block name=head_addon}{/block}
    </head>
    <body>
        <div class="container">
            <div class="span-24 banner">
                <img src="/resources/images/banner.png" alt="Packet Underground" />
            </div>
            
            <div class="span-24 content-container">
                <div class="span-19 content">
                    <!-- Start Content Area -->
                    {block name=content}
                    {$data}
                    {/block}
                    <!-- End Content Area -->
                </div>
                
                <div class="span-5 sidebar last">
                    <!-- Start Sidebar Area -->
                    {block name=sidebar}
                        {strip}
                            {foreach $sideitems as $sideitem}
                               <div class="box side_item">
                                    <h2>{$sideitem.title}</h2>
                                    <ul>
                                        {foreach $sideitem.links as $link}
                                        <li><a href='{$link.uri}'>{$link.title}</a></li>
                                        {/foreach}
                                    </ul>
                                </div>
                            {/foreach}
                        {/strip}
                    {/block}
                    <!-- End Sidebar Area -->
                </div>
            </div>
            <div class="span-24 footer last">
                <div class="box">
                    {block name=footer}Copyright &copy 2013 Shane McIntosh http://packetunderground.com<br />Shinigami-CMS{/block}
                </div>
            </div>
        </div>
    </body>
</html>