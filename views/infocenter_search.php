    <!-- Portfolio Grid Section -->
    <section id="search">
	<div class="container">
		<h2 class="lead"><strong class="text-danger">{{eventsData.length}}</strong>
      results were found for the search for
      <strong class="text-danger">
        <span ng-show="searchType">&#45;{{searchType}}</span>
        <span ng-show="searchKey">&#44;{{searchKey}}</span>
        <span ng-show="searchLoc">&#44;{{searchLoc}}</span>
      </strong>
    </h2>

    <section class="col-xs-12 col-sm-6 col-md-12">
		<article class="search-result row" ng-repeat="eventData in eventsData">
			<div class="col-xs-12 col-sm-12 col-md-3">
				<a href="<?php echo base_url();?>Infocenter/event_display/<?php echo "{{eventData.ae_id}}";?>" title="{{eventData.ae_name}}" class="thumbnail"><img src="<?php echo base_url(); ?>assets/img/infocenter_images/{{eventData.ae_logoimage}}" alt="image" style="height:140px;width:250px;"/></a>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-2">
				<ul class="meta-search">
					<li><i class="glyphicon glyphicon-calendar"></i> <span>{{eventData.ae_startdate}}</span></li>
					<li><i class="glyphicon glyphicon-time"></i> <span>{{eventData.ae_startTime}}</span></li>
					<li><i class="glyphicon glyphicon-tags"></i> <span>{{eventData.ae_type}}</span></li>
					<li><i class="glyphicon glyphicon-map-marker"></i> <span>{{eventData.ae_v_name}}</span>
          <li><i class="glyphicon glyphicon-map-marker"></i> <span>{{eventData.ae_v_city}}</span>
				</ul>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-7 excerpet">
				<h3><a href="<?php echo base_url();?>Infocenter/event_display/<?php echo "{{eventData.ae_id}}";?>" title="">{{eventData.ae_name}}</a></h3>
				<p>{{eventData.ae_description.substr(0,350)}}</p>
        <span class="plus"><a href="<?php echo base_url();?>Infocenter/event_display/<?php echo "{{eventData.ae_id}}";?>" title="{{eventData.ae_name}}"><i class="glyphicon glyphicon-plus"></i></a></span>
			</div>
			<span class="clearfix borda"></span>
		</article>
  </section>
  </div>
</body>
</html>
