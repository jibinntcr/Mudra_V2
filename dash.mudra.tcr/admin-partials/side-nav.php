<?php $path = $_SERVER['PHP_SELF'];
$filenameExt = basename($path);
// print_r($filenameExt);
// exit(); 
?>


<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="../index.php" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="../../images/logo/logo.png">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Mudra</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <?php
        if ($filenameExt == 'category.php' || $filenameExt == 'edit-category.php' || $filenameExt == 'new-category.php') {
            $categoryActive = 'active';
        }
        if ($filenameExt == 'files.php' || $filenameExt == 'edit-file.php' || $filenameExt == 'new-file.php') {
            $fileActive = 'active';
        }
        if ($filenameExt == 'books-category.php' || $filenameExt == 'edit-book-category.php' || $filenameExt == 'new-book-category.php') {
            $bookcat = 'active';
        }
        if ($filenameExt == 'books.php' || $filenameExt == 'new-book.php' || $filenameExt == 'edit-book.php') {
            $book = 'active';
        }


        ?>



        <li class="menu-item <?php echo  $categoryActive ?>">
            <a href="../category/category.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Category</div>
            </a>
        </li>

        <li class="menu-item <?php echo $fileActive ?>">
            <a href="../files/files.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-image"></i>
                <div data-i18n="Analytics">Files</div>
            </a>
        </li>

        <li class="menu-item <?php echo $bookcat ?>">
            <a href="../books-category/books-category.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-image"></i>
                <div data-i18n="Analytics">Book Category</div>
            </a>
        </li>

        <li class="menu-item <?php echo $book ?>">
            <a href="../books/books.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-image"></i>
                <div data-i18n="Analytics">Books</div>
            </a>
        </li>
    </ul>
</aside>