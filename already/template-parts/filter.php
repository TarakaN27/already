<?php
$genre_list = get_categories(['taxonomy' => 'genre']);
?>

<form action="" id="filter">
    <div class="catalog-filter__block">
        <div class="filter-item">
            <span class="filter-item__title">Genre:</span>
            <select class="form-control" name="genre">
                <? foreach($genre_list as $genre): ?>
                    <option value="<?=$genre->term_id?>"><?=$genre->name?></option>
                <? endforeach; ?>
            </select>
        </div>
        <div class="filter-item">
            <span class="filter-item__title">Date from:</span>
            <select class="form-control" name="year_from">
                <? for($i=date('Y')-50; $i<=date('Y'); $i++): ?>
                    <option value="<?=$i?>"><?=$i?></option>
                <? endfor; ?>
            </select>
            <span class="filter-item__title">to</span>
            <select class="form-control" name="year_to">
                <? for($i=date('Y')-50; $i<=date('Y'); $i++): ?>
                    <option value="<?=$i?>" <?= $i == date('Y') ? 'selected': '' ?> ><?=$i?></option>
                <? endfor; ?>
            </select>
        </div>
    </div>
    <button class="btn btn-brown">Apply</button>
</form>