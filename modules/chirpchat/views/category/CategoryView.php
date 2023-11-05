<?php

namespace chirpchat\views\category;

use ChirpChat\Model\Category;

class CategoryView{

    public function __construct(private Category $category){}

    public function show(){
        ?>
        <div class="category-search" style="background-color: <?=$this->category->getColorCode()?>">
            <a href="index.php?action=searchPostInCategory&id=<?=$this->category->getIdCat()?>"></a><?php
            echo '<h3>' . $this->category->getLibelle() . '</h3>';
            echo '<p>' . $this->category->getDescription() . '</p>'; ?>
        </div>
        <?php
    }
}
