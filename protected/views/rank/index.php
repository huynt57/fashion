<div class="df-container title-card with-title-and-menu">
    <div class="intro-text">
        <h2 class="intro-title">Bảng xếp hạng</h2>
        <p class="intro-des">What did I do, what did i say? </p>
    </div>
    <div class="menu-section">
        <div class="main-menu-section">
            <ul>
                <li class="active"><a href="#">Ngày</a></li>
                <li><a href="#">Tuần</a></li>
                <li><a href="#">Tháng</a></li>
                <li><a href="#">Năm</a></li>
            </ul>
        </div>
    </div>
</div>
<?php $this->renderPartial('cards_post', array('data' => $data, 'pages' => $pages)); ?>