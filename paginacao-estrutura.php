<nav aria-label="Page navigation example" >
    <style>
        .page-link {
            color: #739072;
        }
        .page-link:hover{
            color: #739072;
        }
    </style>
<ul class="pagination justify-content-center">
    <?php if ($page_no > 1) {
        echo "<li class='page-item' ><a class='page-link' href='?page_no=1'>Primeira Página</a></li>";
    }
    ?>

    <li class='page-item' <?php if ($page_no <= 1) {
        echo "class='page-item disabled'";
    } ?>>
        <a <?php if ($page_no > 1) {
            echo "class='page-link' tabindex='-1' aria-disabled='true' href='?page_no=$previous_page'";
        } ?>>Voltar</a>
    </li>
    <?php
    if ($total_no_of_pages <= 10) {
        for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
            if ($counter == $page_no) {
                echo "<li class='page-item active'><a>$counter</a></li>";
            } else {
                echo "<li><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
            }
        }
    } elseif ($total_no_of_pages > 10) {
        if ($page_no <= 4) {
            for ($counter = 1; $counter < 8; $counter++) {
                if ($counter == $page_no) {
                    echo "<li class='page-item active'><a>$counter</a></li>";
                } else {
                    echo "<li><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                }
            }
            echo "<li><a>...</a></li>";
            echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
            echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
        }
    }
    ?>
    <li class='page-item' <?php if ($page_no >= $total_no_of_pages) {
        echo "class='page-item disabled'";
    } ?>>
        <a <?php if ($page_no < $total_no_of_pages) {
            echo "class='page-link' href='?page_no=$next_page'";
        } ?>>Próxima</a>
    </li>

    <?php if ($page_no < $total_no_of_pages) {
        echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>Ultima &rsaquo;&rsaquo;</a></li>";
    } ?>
</ul>

</nav>