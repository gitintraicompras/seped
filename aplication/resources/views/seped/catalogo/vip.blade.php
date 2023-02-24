<div class="modal fade " 
	 aria-hidden="true" 
	 role="dialog" 
	 tabindex="-1" 
	 id="modal-vip">
	 <div class="modal-dialog">
		<div class="modal-content" style="border-radius: 20px;" >
			<div class="row" >
				<div style="padding-right: 30px; padding-top: 10px;"  >
					<button type="button" 
						class="close"
						data-dismiss="modal" 
						aria-hidden="true">
						&times;
					</button>
				</div>
			</div>
			<div class="modal-body" style="margin: 0px; padding: 0px;">
				<!-- AREA CHART -->
				<div class="box box-primary" style="margin: 0px; padding: 0px;">
					<div class="box-header">
						<center><h3 class="box-title">{{$cfg->msgLitVip}}, DESCUENTO: {{number_format($dcto, 2, '.', ',')}}%</h3></center>
						<center><h4 class="box-title">{{$cliente->nombre}}</h4></center>
					</div>
					<center>
					<div class="box-body chart-responsive" 
						style="width: 95%; margin: 0px; padding: 0px;">
						<div class="chart" id="bar-chart" style="background-color: #f9f9f9"></div>
					</div>
					</center>
				</div>
			</div>
			<div class="modal-footer" style="margin: 0px; padding: 0px;">
				<center><h4 class="box-title">cuotas vs. acumulado (unidades)</h4></center>
			</div>
		</div>
	</div>
</div>



