<?php 
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
        die(); 
?>

<script>
    let index = 0;
    function moveSlide(step = 1) {
        const slides = document.querySelectorAll('.carousel_embla__slide');
        index = (index + step + slides.length) % slides.length;
        document.querySelector('.carousel_embla__container').style.transform = `translateX(-${index * 100}%)`;
    }

    setInterval(moveSlide, 10000); // Change item every 10 seconds
</script>

<div id="component_carousel" class="component_carousel">
    <div class="carousel_embla__viewport"> 
        <div class="carousel_embla__container">
            <?php foreach ($arResult['NEWS'] as $news) {?>
            <div class="carousel_embla__slide">
                <div class="carousel_news" id=<?= $news['fields']['ID']; ?>>
                    <img class="carousel_embla__slide__img" src="<?= CFile::GetPath($news['fields']['PREVIEW_PICTURE']); ?>" />
                    <div class="carousel_shadow"></div>
                    <div class="carousel_news___texts">
                        <div class="carousel_slider-text">
                            <div class="header-new">
                                <span class="post-date"><?= $news['date']; ?></span>
                                <span class="read-time"><?= $news['props']['read_time']['VALUE']; ?></span>
                            </div>
                            <h5><?= $news['fields']["NAME"] ?></h5>
                            <p><?= $news['fields']["PREVIEW_TEXT"] ?></p>
                        </div>
                        <div class="carousel_tags">
                            <? $APPLICATION->IncludeComponent("firstbit:web.main.tags", ".default", ["news_id" => $news['fields']['ID']]); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div> 
        <button class="carousel_button carousel_embla__button--next" onclick="moveSlide(1)">&#10095;</button> 
        <button class="carousel_button carousel_embla__button--prev" onclick="moveSlide(-1)">&#10094;</button>
    </div>
</div>
