<?php
/**
 * Nova Homepage
 * 
 * @since 2.0.0
 */
class Nova_Homepage extends PH_Template {

    public function render($input)
    {

        get_template_part('header.php', [
            "active_id" => $this->active_id
        ]);

    ?>

    <header class="banner">
        <img src="http://wimsteenbakker.nl/wp-content/uploads/2012/08/Foto-met-alles-5-e1488409976753.jpg" data-speed="-0.75" class="img-parallax" style="top: 45.8331%; transform: translate(-50%, -45.8331%);">
        <div class="banner-text abs-centered fade-in">
            <h1 class="title">"Sfeervolle muziek voor de feestmaanden!"</h1>
            <br><br>
            <a class="button-2 alt" href="contact">Bekijk mijn portfolio</a>
            <a class="button-2" href="contact">Boek een optreden</a>
        </div>
    </header>

    <div class="audioplayer">
        <div class="metadata">
            <span id="apSongTitle">Demo 1</span>&nbsp;-&nbsp;<span id="apSongArtist">Wim Steenbakker</span>
        </div>

        <div class="apButtons">
            <button id="pre" onclick="previous()"><i class="fas fa-step-backward fa-lg" aria-hidden="true"></i></button>
            <button id="play" onclick="playPause()"><i class="fas fa-play fa-lg" aria-hidden="true"></i></button>
            <button id="next" onclick="next()"><i class="fas fa-step-forward fa-lg" aria-hidden="true"></i></button>
        </div>
        
        <div id="apCurrentTime" style="opacity: 1;">00:00</div>

        <div id="apSeekArea">
            <div id="ins-time" style="left: 0px; margin-left: 0px;">00:00</div>
            <div id="apSeekHover" style="width: 0px;"></div>
            <div id="apFill"></div>
        </div>
            
        <div id="apTrackLength" style="opacity: 1;">00:00</div>
    </div>


    <main role="main">

        <section class="intro">
            <img src="https://jezz.tech/sites/wim/assets/img/wim_pf_2.jpg" alt="Wim Steenbakker">
            <div class="intro-text">
            <h1 class="title">Hallo! Ik ben Wim Steenbakker</h1>
            <p>Dit is jouw korte praatje waarin je duidelijk kan maken wie je bent en wat je doet. Dit kan dus betrekking hebben tot acedemische prestaties, vertrouwelijkheid of andere dingen die jou echt uniek maken. Houd het kort en bondig.</p>
            <br><a class="button-1" href="/wim/over">Lees meer</a>
            </div>
        </section>


        <section class="events-media">
            <div class="events">
            <h2 class="title">Evenementen</h2>
                
            <div class="event-flex">
                
                <div class="event-card current">
                <div class="date">
                    <p class="date-int">24</p>
                    <p class="date-month">nov</p>
                </div>
                <div class="metadata">
                    <strong>Winterfair Heinkenszand</strong>
                    <p>19:00 – 19:30</p>
                    <p><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Heinkenszand</p>
                </div>
                </div>

                <div class="event-card">
                <div class="date">
                    <p class="date-int">20</p>
                    <p class="date-month">dec</p>
                </div>
                <div class="metadata">
                    <strong>KBO Ovezande</strong>
                    <p>14:00 – 15:15</p>
                    <p><i class="fas fa-map-marker-alt" aria-hidden="true"></i> KBO Ovezande</p>
                </div>
                </div>

                <div class="event-card">
                <div class="date">
                    <p class="date-int">23</p>
                    <p class="date-month">dec</p>
                </div>
                <div class="metadata">
                    <strong>Kerstoptreden Cederhof 1</strong>
                    <p>20:00 – 21:30</p>
                    <p><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Cederhof, Kapelle</p>
                </div>
                </div>
                
            </div>
            <a href="/wim/contact" class="underline"><span>Bekijk alle evenementen →</span></a>
            </div>
            
            <div class="media">
            <h2 class="title" style="margin-bottom: 8px;">Laatste mededelingen</h2>
            
            <div class="media-grid">
                
                <div class="pola-card">
                <div class="top"><img src="https://jezz.tech/sites/wim/assets/img/wim_pf.jpg" alt="Montmartre Goes"></div>
                <div class="bottom">
                    <div class="metadata">
                    <span>23/01/2020</span>
                    </div>
                    <h3>Montmartre Goes</h3>
                    <p>Het optreden bij Montmartre was vol plezier! Ik heb erg genoten van het energieke publiek en zulke dingen.</p>
                    <hr>
                    <a href="#">Info</a>
                </div>
                </div>

                <div class="pola-card">
                <div class="top"><img src="https://jezz.tech/sites/wim/assets/img/wim_pf_2.jpg" alt="Montmartre Goes"></div>
                <div class="bottom">
                    <div class="metadata">
                    <span>07/11/2019</span>
                    </div>
                    <h3>Jouw titel hier</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem eaque pariatur nam.</p>
                    <hr>
                    <a href="#">Info</a>
                </div>
                </div>

            </div>
            </div>
        </section>
    </main>

    <div id="scroll-up" class="overlay-button" onclick="scrollUp()">
        <i class="fas fa-angle-up abs-centered" aria-hidden="true"></i>
    </div>
        
    <?php

        // get_template_part('footer.php', []);

    }

    public function __construct()
    {
        global $theme_folder;
        $this->requested_stylesheets = [
            request_stylesheet(uri_resolve('/data/themes/'. $theme_folder .'/css/nova.css')),
            request_stylesheet(uri_resolve('/data/themes/'. $theme_folder .'/css/musicplayer.css'))
        ];
        $this->requested_header_scripts = [
            request_script('https://kit.fontawesome.com/9d8cef91c5.js')
        ];
        $this->requested_body_scripts = [request_script(ph_pattern('%THEME%/js/main.js'))];
        $this->requested_title = "Home - " . get_template_record('website_name');
        $this->active_id = 'index';
    }

}

return new PH_Export('index', [
    "class" => "Nova_Homepage"
]);
