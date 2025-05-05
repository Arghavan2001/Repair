<div class="col-12 col-sm-6 col-md-4 mb-4 d-flex justify-content-center">
                        <div class="my-blog-post shadow-sm w-100 h-100 d-flex flex-column">

                            <!-- فضای تصویر -->
                            <div class="my-card-img-container">
                                <?php if (has_post_thumbnail()): ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('large', ['class' => 'w-100 rounded']); ?>
                                    </a>
                                <?php endif; ?>
                            </div>

                            <!-- بدنه کارت -->
                            <div class="my-card-body d-flex flex-column">
                                <h5 class="my-card-title">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                        <?php the_title(); ?>
                                    </a>
                                </h5>

                                <div class="cat-date">
                                    <?php
                                    $cat = get_the_category();
                                    echo $cat ? implode(', ', array_map(fn($c) => '<a href="' . esc_url(get_category_link($c->term_id)) . '" class="cat-link">' . esc_html($c->name) . '</a>', $cat)) : 'بدون دسته‌بندی';
                                    ?>
                                    <span class="meta text-muted mb-3 small mx-1">|</span>
                                    <?php 
                                        $timestamp = get_the_time( 'U' ); 
                                        $jdate = new jDateTime(true, true, 'Asia/Tehran'); // فعال‌سازی تبدیل، تایم‌زون
                                        $persian_date = $jdate->date('j F Y ', $timestamp);
                                    
                                    ?>
                                    
                                    <span class="my-date"><?= $persian_date ?></span>
                                </div>

                                <p class="my-card-text text-secondary flex-grow-1">
                                    <?= get_the_excerpt(); ?>
                                </p>

                                <div class="text-right mt-3">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary">مشاهده آموزش</a>
                                </div>
                            </div>

                        </div>
                    </div>