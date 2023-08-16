<?php

    class PageNavigation {
        public $totalItems = 0;
        public $itemPerPage = 10;

        function setTotalItems($total) {
            $this->totalItems = $total;
        }
        function setItemsPerPage($limit) {
            $this->itemPerPage = $limit;
        }

        function getNavigation($uri, $page) {
            $total_pages = ceil($this->totalItems / $this->itemPerPage);

            if ($total_pages > 1) {
                // Validate the current page number
                $page = max($page, 1);
                $page = min($page, $total_pages);
            
                // Generate the "Previous" button link
                $prev_page = $page - 1;
                $delimiter = str_contains($uri, '?') ? '&' : '?';

                if ($prev_page >= 1) {
                    echo '<li class="page-item"><a class="page-link" aria-label="Previous" href="'.$uri.$delimiter.'page=' . $prev_page . '">«</a></li>';
                }
            
                // Create the pagination links
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $page) {
                        echo '<li class="page-item active"><a class="page-link" href="#">' . $i. '</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="'.$uri.$delimiter.'page=' .$i. '">'.$i. '</a></li>';
                    }
                }
            
                // Generate the "Next" button link
                $next_page = $page + 1;
                if ($next_page <= $total_pages) {
                    echo '<li class="page-item"><a class="page-link" aria-label="Next" href="'.$uri.$delimiter.'page=' . $next_page . '">»</a></li>';
                }
            }
        }

    }

?>
