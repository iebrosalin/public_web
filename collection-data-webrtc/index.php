<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/App/Main/load.php');



use App\Main\Helper as Helper;
use App\Main\App as App;

require_once (App::HEADER);

?>
<!-- Banner -->
<section id="banner">
    <div class="inner">
        <div class="logo"><span class="icon fa-diamond"></span></div>
        <h2>Diplom-alpha</h2>
        <p>Главная страница</p>
    </div>
</section>
				<!-- Wrapper -->
					<section id="wrapper">

						<!-- One -->
						<? /*	<section id="one" class="wrapper spotlight style1">
								<div class="inner">
									<a href="#" class="image"><img src="images/pic01.jpg" alt="" /></a>
									<div class="content">
										<h2 class="major">Magna arcu feugiat</h2>
                                        <p> <? Helper::p($_SERVER);?></p>
										<a href="#" class="special">Learn more</a>
									</div>
								</div>
							</section>*/?>

						<!-- Two -->
							<? /*<section id="two" class="wrapper alt spotlight style2">
								<div class="inner">
									<a href="#" class="image"><img src="images/pic02.jpg" alt="" /></a>
									<div class="content">
										<h2 class="major">Tempus adipiscing</h2>
										<p>Lorem ipsum dolor sit amet, etiam lorem adipiscing elit. Cras turpis ante, nullam sit amet turpis non, sollicitudin posuere urna. Mauris id tellus arcu. Nunc vehicula id nulla dignissim dapibus. Nullam ultrices, neque et faucibus viverra, ex nulla cursus.</p>
										<a href="#" class="special">Learn more</a>
									</div>
								</div>
							</section>*/?>

						<!-- Three -->
							<? /*<section id="three" class="wrapper spotlight style3">
								<div class="inner">
									<a href="#" class="image"><img src="images/pic03.jpg" alt="" /></a>
									<div class="content">
										<h2 class="major">Nullam dignissim</h2>
										<p>Lorem ipsum dolor sit amet, etiam lorem adipiscing elit. Cras turpis ante, nullam sit amet turpis non, sollicitudin posuere urna. Mauris id tellus arcu. Nunc vehicula id nulla dignissim dapibus. Nullam ultrices, neque et faucibus viverra, ex nulla cursus.</p>
										<a href="#" class="special">Learn more</a>
									</div>
								</div>
							</section>*/?>

						<!-- Four -->
							<section id="four" class="wrapper alt style1">
								<div class="inner">
                                    <? //require_once ($_SERVER['DOCUMENT_ROOT']."/pages/pagesBlock.php");?>
                                     <? foreach (App::getSection('/pages') as $folder):?>
                                         <h3 class="major"><?= $folder?></h3>
                                         <section class="features">
                                         <? foreach (App::getSectionFile('/pages/'.$folder) as $file ):?>
                                                <article>
                                                    <? /*<a href="#" class="image"><img src="images/pic04.jpg" alt="" /></a>*/?>
                                                    <h3 class="major"><?= explode('.',$file)[0]?></h3>
                                                    <?/*<p>Получение снимка с вебкамеры.</p>*/?>
                                                    <a href="<?='/pages/'.$folder.'/'.$file?>" class="special">Learn more</a>
                                                </article>
                                         <? endforeach;?>
                                         </section>
                                     <? endforeach;?>
                                    <?	/*<ul class="actions">
										<li><a href="#" class="button">Browse All</a></li>
									</ul>*/?>
								</div>
							</section>

					</section>
<?
require_once (App::FOOTER);?>
