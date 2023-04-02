<!--===============================================================
// Nom du fichier : connexion_succes.php
// Auteur : A.GOUUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V1
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// affichage du succès de la connexion dans la partie admin
//-------------------------------------------------------------
// A noter :
// affiche aussi une partie de la page admin de base pour l'instant inutile sert juste à avoir une iddé de ce à quoi ça peut ressembler
// sinon vue très vide et sans grand intéret puisque pour l'intant la connexion n'est absolument pas vérifiée il suffit de taper des choses dans les champs
//===============================================================-->

 <div class="realtime-statistic-area">
    <div class="container">
        <div class="row">
            <br></br>
            <p>Connexion réussie ! Bienvenu dans votre espace administration .</p>
        </div>     
    </div>
</div>

<!-- Start Realtime sts area-->
    <div class="realtime-statistic-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="realtime-wrap notika-shadow mg-t-30">
                        <div class="realtime-ctn">
                            <div class="realtime-title">
                                <h2>Realtime Visitors</h2>
                            </div>
                        </div>
                        <div class="realtime-visitor-ctn">
                            <div class="realtime-vst-sg">
                                <h4><span class="counter">4,35,456</span></h4>
                                <p>Visitors last 24h</p>
                            </div>
                            <div class="realtime-vst-sg">
                                <h4><span class="counter">4,566</span></h4>
                                <p>Visitors last 30m</p>
                            </div>
                        </div>
                        <div class="realtime-map">
                            <div class="vectorjsmarp" id="world-map"></div>
                        </div>
                        <div class="realtime-country-ctn realtime-ltd-mg">
                            <h5>September 4, 21:44:02 (2 Mins 56 Seconds)</h5>
                            <div class="realtime-ctn-bw">
                                <div class="realtime-ctn-st">
                                    <span><img src="img/country/1.png" alt="" /></span> <span>United States</span>
                                </div>
                                <div class="realtime-bw">
                                    <span>Firefox</span>
                                </div>
                                <div class="realtime-bw">
                                    <span>Mac OSX</span>
                                </div>
                            </div>
                        </div>
                        <div class="realtime-country-ctn">
                            <h5>September 7, 20:44:02 (5 Mins 56 Seconds)</h5>
                            <div class="realtime-ctn-bw">
                                <div class="realtime-ctn-st">
                                    <span><img src="img/country/2.png" alt="" /></span> <span>Australia</span>
                                </div>
                                <div class="realtime-bw">
                                    <span>Firefox</span>
                                </div>
                                <div class="realtime-bw">
                                    <span>Mac OSX</span>
                                </div>
                            </div>
                        </div>
                        <div class="realtime-country-ctn">
                            <h5>September 9, 19:44:02 (10 Mins 56 Seconds)</h5>
                            <div class="realtime-ctn-bw">
                                <div class="realtime-ctn-st">
                                    <span><img src="img/country/3.png" alt="" /></span> <span>Brazil</span>
                                </div>
                                <div class="realtime-bw">
                                    <span>Firefox</span>
                                </div>
                                <div class="realtime-bw">
                                    <span>Mac OSX</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="add-todo-list notika-shadow mg-t-30">
                        <div class="realtime-ctn">
                            <div class="realtime-title">
                                <h2>Add Todo</h2>
                            </div>
                        </div>
                        <div class="card-box">
                            <div class="todoapp">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-sm-6 col-xs-12">
                                        <h4 id="todo-message"><span id="todo-remaining"></span> of <span id="todo-total"></span> remaining</h4>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="notika-todo-btn">
                                            <a href="#" class="pull-right btn btn-primary btn-sm" id="btn-archive">Archive</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="notika-todo-scrollbar">
                                    <ul class="list-group no-margn todo-list" id="todo-list"></ul>
                                </div>
                                <div id="todo-form">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-sm-12 col-xs-12 todo-inputbar">
                                            <div class="form-group todo-flex">
                                                <div class="nk-int-st">
                                                    <input type="text" id="todo-input-text" name="todo-input-text" class="form-control" placeholder="Add new todo">
                                                </div>
                                                <div class="todo-send">
                                                    <button class="btn-primary btn-md btn-block btn notika-add-todo" type="button" id="todo-btn-submit">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="notika-chat-list notika-shadow mg-t-30 tb-res-ds-n dk-res-ds">
                        <div class="realtime-ctn">
                            <div class="realtime-title">
                                <h2>Chat Box</h2>
                            </div>
                        </div>
                        <div class="card-box">
                            <div class="chat-conversation">
                                <div class="widgets-chat-scrollbar">
                                    <ul class="conversation-list">
                                        <li class="clearfix">
                                            <div class="chat-avatar">
                                                <img src="img/post/1.jpg" alt="male">
                                                <i>10:00</i>
                                            </div>
                                            <div class="conversation-text">
                                                <div class="ctext-wrap">
                                                    <i>John Deo</i>
                                                    <p>
                                                        Hello!
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="clearfix odd">
                                            <div class="chat-avatar">
                                                <img src="img/post/2.jpg" alt="Female">
                                                <i>10:01</i>
                                            </div>
                                            <div class="conversation-text">
                                                <div class="ctext-wrap chat-widgets-cn">
                                                    <i>Smith</i>
                                                    <p>
                                                        Hi, How are you? What about our next meeting?
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="chat-avatar">
                                                <img src="img/post/1.jpg" alt="male">
                                                <i>10:01</i>
                                            </div>
                                            <div class="conversation-text">
                                                <div class="ctext-wrap">
                                                    <i>John Deo</i>
                                                    <p>
                                                        Yeah everything is fine
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="clearfix odd">
                                            <div class="chat-avatar">
                                                <img src="img/post/2.jpg" alt="male">
                                                <i>10:02</i>
                                            </div>
                                            <div class="conversation-text">
                                                <div class="ctext-wrap chat-widgets-cn">
                                                    <i>Smith</i>
                                                    <p>
                                                        Wow that's great
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="chat-avatar">
                                                <img src="img/post/1.jpg" alt="male">
                                                <i>10:01</i>
                                            </div>
                                            <div class="conversation-text">
                                                <div class="ctext-wrap">
                                                    <i>John Deo</i>
                                                    <p>
                                                        Doing Better i am thinking about that..
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="clearfix odd">
                                            <div class="chat-avatar">
                                                <img src="img/post/2.jpg" alt="male">
                                                <i>10:02</i>
                                            </div>
                                            <div class="conversation-text">
                                                <div class="ctext-wrap chat-widgets-cn">
                                                    <i>Smith</i>
                                                    <p>
                                                        Wow, You also tallent man...
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="chat-widget-input">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-sm-12 col-xs-12 chat-inputbar">
                                            <div class="form-group todo-flex">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control chat-input" placeholder="Enter your text">
                                                </div>
                                                <div class="chat-send">
                                                    <button type="submit" class="btn btn-md btn-primary btn-block notika-chat-btn">Send</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Realtime sts area-->