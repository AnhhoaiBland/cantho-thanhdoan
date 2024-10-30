<style>
    h1 {
        padding: 0 0 10px 0;
    }

    ul {
        margin-left: 30px;
        counter-reset: item;
    }

    .wtree li {
        list-style-type: none;
        margin: 10px 0 10px 10px;
        position: relative;
    }

    .wtree li:before {
        content: "";
        counter-increment: item;
        position: absolute;
        top: -10px;
        left: -30px;
        border-left: 1px solid #033e8c;
        border-bottom: 1px solid #033e8c;
        width: 30px;
        height: 15px;
    }

    .wtree li:after {
        position: absolute;
        content: "";
        top: 5px;
        left: -30px;
        border-left: 1px solid #033e8c;
        border-top: 1px solid #033e8c;
        width: 30px;
        height: 100%;
    }

    .wtree li:last-child:after {
        display: none;
    }

    .wtree li span {
        display: block;
        border: 1px solid #ddd;
        padding: 10px;
        color: rgba(102, 102, 102, 1);
        text-decoration: none;
    }

    .wtree li span:before {
        /* content: counters(item, ".") " "; */
    }

    .wtree li span:hover,
    .wtree li span:focus {
        color: #000;
        border: 1px solid #474747;
    }

    .wtree li span:hover+ul li span,
    .wtree li span:focus+ul li span {
        color: #000;
        border: 1px solid #474747;
    }

    .wtree li span:hover+ul li:after,
    .wtree li span:focus+ul li:after,
    .wtree li span:hover+ul li:before,
    .wtree li span:focus+ul li:before {
        border-color: #474747;
    }

    li span {
        background-color: #ddf3fe;
    }

    li li span {
        background-color: #ddebc8;
    }

    li li li span {
        background-color: #fefcd5;
    }

    .display {
        margin-right: 12px;
        font-weight: bold;
    }

    input,
    label {
        margin: 12px 0px 20px 0px;
    }

    label {
        padding-left: 6px;
        padding-right: 12px;
    }

    
</style>
<?php
function generateTree($categories)
{
    $html = '<ul class="wtree">';
    foreach ($categories as $category) {
        $html .= '<li><span>' . $category['tenChuyenMuc'] . '</span>';
        if (!empty($category['subcategories'])) {
            $html .= generateTree($category['subcategories']);
        }
        $html .= '</li>';
    }
    $html .= '</ul>';
    return $html;
}

// Output category tree
echo generateTree($categoryTree);

?>