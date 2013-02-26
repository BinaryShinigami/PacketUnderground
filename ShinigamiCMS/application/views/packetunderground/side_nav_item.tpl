                    <div class="box side_item">
                        <h2>{$sideitem.title}</h2>
                        <ul>
                            {foreach $sideitem.links as $link}
                            <li><a href='{$link.uri}'>{$link.title}</a></li>
                            {/foreach}
                        </ul>
                    </div>