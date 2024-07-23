<?php

if(!empty($_SESSION['USER']))
        session_destroy();


    redirect('home');

