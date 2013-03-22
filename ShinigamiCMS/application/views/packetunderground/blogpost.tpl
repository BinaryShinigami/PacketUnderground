                    <!-- Blog Post -->
                    <div class="box entry">
                        <h2><a href="/blog/slug/{$post.slug}">{$post.title}</a></h2>
                        <div class="entry_details">
                            <span class='author small'>Author: {$post.author}</span>
                            <span class="datetime small">Created: {$post.timestamp}</span>
                            <div class="clear"></div>
                        </div>
                        <p>
                            {$post.content}
                        </p>
                        <div class="entry_footer"><a href="/blog/slug/{$post.slug}#comments">Comments ({$post.comment_count})</a></div>
                        <div class="clear"></div>
                    </div>
                    <!-- End Blog Post -->