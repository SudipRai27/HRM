<?php 
  //url for the tabs
  $tabs = array(
                array('url' => URL::route('create-fb-posts'),
                      'alias' => 'Facebook Posts with Links '),                

				array('url' => URL::route('create-fb-posts-with-image'),
                      'alias' => 'Facebook Posts with Image '),                                                                 

                );
?>


<div class="nav-tabs-custom">            
    <ul class="nav nav-tabs">
      @foreach($tabs as $tab)
        <li @if(Request::url() == $tab['url']) class="active" @endif><a href="{{$tab['url']}}">{{$tab['alias']}}</a></li>
      @endforeach
     
    </ul>
</div>

