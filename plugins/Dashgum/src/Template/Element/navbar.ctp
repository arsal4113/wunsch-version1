<header class="header black-bg">
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
    </div>
    <a href="/" class="logo"><b>i-Tool 3</b> \\ DEV</a>
    <div class="top-menu">
        <ul class="nav pull-right top-menu">
            <?php 
                if($authUser) {
                    echo "<li>" . $this->Html->link(__('Logout'), ['controller' => 'CoreUsers', 'action' => 'logout', 'plugin' => false], ['class' => 'logout']) . "</li>";
                }        
            ?>
        </ul>
    </div>
</header>