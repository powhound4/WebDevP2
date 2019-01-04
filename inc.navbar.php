<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>       
                <span class="icon-bar"></span>      
                <span class="icon-bar"></span>                      
            </button>
                <a class="navbar-brand" href="./index.php" style="font-family: 'Trade Winds';font-size: 22px;">MTN EATZ</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="dropdown">          
                    <a href="#TODO" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ingredients<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        <?php
                        include_once('database.php');
                        $data = new Database();
                        $in = $data->getIngredients();
                        foreach($in as $food){ ?>
                            <li><a href="./ingredients.php?page=<?php echo $food['NAME']?>"><?php echo $food['NAME']?></a></li>
                            <?php } ?>
                        </ul>
                </li>
                <li><a href="./aboutus.php" >About Us</a></li>
                <?php if (!isset($_SESSION['UserName'])) { ?>
                     <li><a href="./login.php" >Log In</a></li>
            <?php   } ?>
                    
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href= "./cart.php" id="cart-popover">Shopping Cart<span class="glyphicon glyphicon-shopping-cart"></span></a></li>
                 <!--{{ $cart_total == 0 ? "Nada no carrinho!" : ("R$ " . number_format($cart_total, 2, ',', '.'))   }}-->
               
                    <?php if (isset($_SESSION['UserName'])) { ?>
                        <li class="dropdown">          
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello! <?php  echo $_SESSION['UserName'] ?><span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="./logoutlink.php">Log Out</a></li>
                                    <?php if ($_SESSION['admin'] == "TRUE") { ?>
                                            <li><a href="./create.php" >Create New Ingredient</a></li>
                                    <?php   } ?>
                                </ul>
                        </li>
                    <?php   }?>
            </ul>
        </div>
        </div>
   </nav>
