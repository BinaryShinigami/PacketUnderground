                    <div class="box side_item">
                        <h2>{title}</h2>
                        <ul>
                            {foreach $links as $link}
                            <li><a href='{$link.uri}'>{$link.title}</a></li>
                            {/foreach}
                        </ul>
                    </div>