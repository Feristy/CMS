		</div>
		<script src="../include/plugins/jquery/jquery.js" type="text/javascript"></script>
		<script src="../include/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/main.js" type="text/javascript"></script>
		<?php if(!empty($chart)){?>
		<script src="../include/plugins/chart.js/Chart.min.js"></script>
		<script type="text/javascript">
			var ctx = document.getElementById("myAreaChart");
			var myLineChart = new Chart(ctx, {
			  type: 'line',
			  data: {
			    labels: [<?php
			    	$chart_time = time();
			    	$chart_times = array();
			    	for($ch=0; $ch < 7; $ch++){
			    		$chart_times[] = $chart_time;
			    		$chart_time -= 86400;
			    	}
			    	$tgl = array_reverse($chart_times);
			    	for($cht=0; $cht < 7; $cht++){
			    		echo '"'.date('d M', $tgl[$cht]).'",';
			    	}
			    ?>],
			    datasets: [{
			      label: "Vistors",
			      lineTension: 0.3,
			      backgroundColor: "rgba(2,117,216,0.2)",
			      borderColor: "#337ab7",
			      pointRadius: 5,
			      pointBackgroundColor: "#337ab7",
			      pointBorderColor: "rgba(255,255,255,0.8)",
			      pointHoverRadius: 5,
			      pointHoverBackgroundColor: "#337ab7",
			      pointHitRadius: 20,
			      pointBorderWidth: 2,
			      data: [
			      <?php
			      $chart_times = array_reverse($chart_times);
			      foreach ($chart_times as $value_chart_times) {
			      	$chart_tgl = date('Y-m-d', $value_chart_times);
			      	$chart_data = $data->read('traffic', 'date', $chart_tgl);
			      	$chart_data = !empty($chart_data) ? $chart_data['vistor']: 0;
			      	echo $chart_data.',';
			      }
			      ?>
					],
			    }],
			  },
			  options: {
			    scales: {
			      xAxes: [{
			        time: {
			          unit: 'date'
			        },
			        gridLines: {
			          display: false
			        },
			        ticks: {
			          maxTicksLimit: 7
			        }
			      }],
			      yAxes: [{
			        ticks: {
			          min: 0,
			          max: 200,
			          maxTicksLimit: 5
			        },
			        gridLines: {
			          color: "rgba(0, 0, 0, .125)",
			        }
			      }],
			    },
			    legend: {
			      display: false
			    }
			  }
			});
		</script>
		<?php } if(!empty($sortable)){?>
		<script src="../include/plugins/jquery-sortable/jquery-sortable.js" type="text/javascript"></script>
		<script type="text/javascript">
			var adjustment;
			var group = $("ul.menu_drop_targets").sortable({
				group: 'limited_drop_targets',
				onDragStart: function ($item, container, _super) {
			    	var offset = $item.offset(),
			        pointer = container.rootGroup.pointer;

			    	adjustment = {
			      		left: pointer.left - offset.left,
			      		top: pointer.top - offset.top
			    	};

			    	_super($item, container);
			  	},
				onDrag: function ($item, position) {
					$item.css(position),
					$item.css({height: $item.outerHeight('40px')}),
					$item.css({
				      	left: position.left - adjustment.left,
				      	top: position.top - adjustment.top
				    });
				},
				onDrop: function ($item, container, _super) {
			    	$('#input_position').val(group.sortable("serialize").get().join("\n"));
			    	_super($item, container);
			  	},
			  	serialize: function (parent, children, isContainer) {
			    	return isContainer ? children.join() : parent.attr('data-id');
			  	},
			  	tolerance: 6,
			  	distance: 10
			});
		</script>
		<?php } if(!empty($codemirror)){?>
		<script src="../include/plugins/codemirror/lib/codemirror.js"></script>
		<script src="../include/plugins/codemirror/addon/display/fullscreen.js"></script>
		<script src="../include/plugins/codemirror/addon/search/match-highlighter.js"></script>
		<script src="../include/plugins/codemirror/addon/dialog/dialog.js"></script>
		<script src="../include/plugins/codemirror/addon/search/searchcursor.js"></script>
		<script src="../include/plugins/codemirror/addon/search/search.js"></script>
		<script src="../include/plugins/codemirror/addon/scroll/annotatescrollbar.js"></script>
		<script src="../include/plugins/codemirror/addon/search/matchesonscrollbar.js"></script>
		<script src="../include/plugins/codemirror/addon/search/jump-to-line.js"></script>
		<script type="text/javascript">
			var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
		        lineNumbers: true,
		        lineWrapping: true,
		        mode: "application/x-httpd-php",
		        highlightSelectionMatches: {showToken: /\w/, annotateScrollbar: true},
		        extraKeys: {
			        "F11": function(cm) {
			          cm.setOption("fullScreen", !cm.getOption("fullScreen"));
			        },
			        "Esc": function(cm) {
			          if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
			        },
			        "Alt-F": "findPersistent"
			    }
		    });
		</script>
		<?php } if(!empty($tinymce)){?>
		<script src="../include/plugins/tinymce/tinymce.min.js" type="text/javascript"></script>
		<script src="../include/plugins/tinymce/settext.js" type="text/javascript"></script>
		<?php } if(!empty($tag_it)){?>
		<script src="../include/plugins/jquery/jquery.min.js" type="text/javascript"></script>
		<script src="../include/plugins/jquery/jquery-ui.min.js" type="text/javascript"></script>
		<script src="../include/plugins/tag-it/tag-it.js" type="text/javascript"></script>
		<script type="text/javascript">

			var sampleTags = [<?php $sample_tag = $data->read('tag'); foreach ($sample_tag as $sample_tags) {echo "'".$sample_tags['name']."',";}?>];
			$(function() {
				$('#singleFieldTags').tagit({
					availableTags: sampleTags,
				    singleField: true,
				    singleFieldNode: $('#mySingleField')
				});
			});
		</script>
		<?php }?>
	</body>
</html>