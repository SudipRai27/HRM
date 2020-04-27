<?php 
  //url for the tabs
  $tabs = array(
                array('url' => URL::route('list-leave'),
                      'alias' => 'Leave Request List'),                

                array('url' => URL::route('leave-history'),
                      'alias' => 'Leave History'),                

                array('url' => URL::route('leave-logs'),
                      'alias' => 'Leave Logs'),                                               
                );
?>


<div class="nav-tabs-custom">            
    <ul class="nav nav-tabs">
      @foreach($tabs as $tab)
        <li @if(Request::url() == $tab['url']) class="active" @endif><a href="{{$tab['url']}}">{{$tab['alias']}}</a></li>
      @endforeach
     
    </ul>
</div>

