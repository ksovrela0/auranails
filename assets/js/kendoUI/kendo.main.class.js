class kendoUI{
	loadKendoUI(url, action, itemPerPage, columnsCount, columnsSQL, gridName, actButtons, editType, columnNames, filtersCustomOperators, showOperatorsByColumns, selectorsForFilters, hidden='', filter=0, locked = '', lockable = '', freezeing_rows=0, pdfEnabled = false, excelEnabled = false, CampaignEnabled = false){
		this.ajaxURL = url;
		this.daction = action;
		this.itemPerPage = itemPerPage;
		this.columnsCount = columnsCount;
		this.columnsSQL = columnsSQL;
		this.gridName = gridName;
		this.actButtons = actButtons;
		this.editType = editType;
		this.hidden = hidden;
		this.freezeing_rows = freezeing_rows;
		this.pdfEnabled = pdfEnabled;
		this.excelEnabled = excelEnabled;
		this.CampaignEnabled = CampaignEnabled;
		
		if(filtersCustomOperators !== ''){
			this.customOperators = JSON.parse(filtersCustomOperators);
		}
		
		if(filter == 0){
			this.filterable = JSON.parse('{"mode": "row"}');
		}
		else{
			this.filterable = true;
		}

		//  LOADING COLUMNS AND MODELS BEGIN
		this.getColumnsURL = this.ajaxURL+"?act=get_columns&count="+this.columnsCount;
		var self = this;
		$.ajax({
			url: this.getColumnsURL,
			data: {cols: columnsSQL, names: columnNames, operators: showOperatorsByColumns, selectors: selectorsForFilters, locked: locked, lockable: lockable},
			dataType: "json",
			success: function(kendoData) {
				self.generateGrid(kendoData);
			}
		});


		
		// LOADING COLUMNS AND MODELS END
	}

	generateGrid(kendoData){
		this.dataSource = new kendo.data.DataSource({
			transport: {
				read:  {
					url: this.ajaxURL + "?act="+this.daction+"&count="+this.columnsCount+"&cols="+this.columnsSQL+this.hidden,
					dataType: "json"
				},
				update: {
					url: this.ajaxURL + "?act=save_priority",
					dataType: "json"
				},
				destroy: {
					url: this.ajaxURL + "?act=disable",
					dataType: "json"
				},
				create: {
					url: this.ajaxURL + "/Products/Create",
					dataType: "json"
				},
				
				parameterMap: function(data, options, operation) {
					
					if (operation !== "read" && options.models) {
						return {models: kendo.stringify(options.models)};
					}
					else {
						return {add: kendo.stringify(data)};
					}
				}
			},
			batch: true,
			pageSize: this.itemPerPage,
			
			schema: {
				model: kendoData.modelss,
				total: 'total',
				data: function (data) {
					return data.data;
				}
			},
			serverFiltering: false,
			serverPaging: false
		});
		
		$("#"+this.gridName).empty();

		var self = this;
		var onDataBound = (arg) => { 
			var KendoisLoaded = true;
			self.getStatus(KendoisLoaded, this.gridName);
			if(this.gridName == 'kendo_given'){
				const kendo = new kendoUI();
				var category_id = $("#dep_project_0").val();
					$.ajax({
						url: aJaxURL,
						data: "act=get_given_result_reason_data&inc_id="+$("#hidden_incomming_call_id").val()+"&directory_type="+category_id,
						success: function(data) {
							var given_ids = data.given_ids;

							given_ids.forEach(function(name, index){
								var given_id = given_ids[index].id;
								var given_result = given_ids[index].info_result;
								var given_reason = given_ids[index].result_reason;
								setTimeout(function(){ 
									kendo.kendoSelector('results_'+given_id,'server-side/call/incomming.action.php', 'get_given_results', "---",given_result);
									kendo.kendoSelector('reasons_'+given_id,'server-side/call/incomming.action.php', 'get_given_reasons', "---",given_reason);
								},300);
								GetDateTimes('app_time_'+given_id);
								GetDateTimes('write_time_'+given_id);
							});
						}
					});
			}
		}

		var freeze = function (e){
			e.sender.element.find(".customHeaderRowStyles").remove();
            var items = e.sender.items();
            e.sender.element.height(e.sender.options.height);   
            items.each(function(){
              var row = $(this);
              var dataItem = e.sender.dataItem(row);
              if(dataItem.id2 == '<img style="margin-bottom: 3px;" src="media/images/icons/star.png">'){
                  var item = row.clone();                
                  item.addClass("customHeaderRowStyles");
                  var thead = e.sender.element.find(".k-grid-header table thead");
                  thead.append(item);
                    e.sender.element.height(e.sender.element.height() + row.height());                
                  row.hide();
              }
			});
			
		}


		var customTools = [];
		var AddInCampaignButton = '<a id="select_campaign" role="button" class="k-button k-button-icontext k-grid-dictionary-add"><span class="k-icon k-i-dictionary-add"></span> კამპანიაში დამატება</a>';
		
		if(this.CampaignEnabled){
			customTools.push({ 	template: AddInCampaignButton	});
		}
		if(this.actButtons != ''){
			customTools.push({	template: this.actButtons	});
		}
		if(this.pdfEnabled){
			customTools.push({ 	name: "pdf"	 })
		}
		if(this.excelEnabled){
			customTools.push({	name: "excel"	})
		}
	
		if(this.freezeing_rows == 0){
			$("#"+this.gridName).kendoGrid({
				toolbar: customTools,
				pdf: {
					allPages: true,
					avoidLinks: true,
					paperSize: "A4",
					margin: { top: "2cm", left: "1cm", right: "1cm", bottom: "1cm" },
					landscape: true,
					repeatHeaders: true,
					template: $("#page-template").html(),
					scale: 0.8
				},
				dataSource: this.dataSource,
				selectable: "multiple",
				allowCopy: true,
				persistSelection: true,
				//height: 350,
				sortable: true,
				filterable: true,
				pageable: {
					refresh: true,
					pageSizes: true,
					buttonCount: 5
				},
				// toolbar: this.actButtons,
				columns: kendoData.columnss,
				editable: this.editType,
				dataBound: onDataBound
			});
		}
		else{
			$("#"+this.gridName).kendoGrid({
				toolbar: customTools,
				pdf: {
					allPages: true,
					avoidLinks: true,
					paperSize: "A4",
					margin: { top: "2cm", left: "1cm", right: "1cm", bottom: "1cm" },
					landscape: true,
					repeatHeaders: true,
					template: $("#page-template").html(),
					scale: 0.8
				},
				dataSource: this.dataSource,
				selectable: "multiple",
				allowCopy: true,
				persistSelection: true,
				height: 400,
				sortable: true,
				filterable: true,
				pageable: {
					refresh: true,
					pageSizes: true,
					buttonCount: 5
				},
				columns: kendoData.columnss,
				editable: this.editType,
				
				dataBound: freeze
			});
		}
		
	}
		
	getStatus(KendoisLoaded, gridName){
		if(gridName == "project_table"){ // დროებითია
			excel_upload()
		}

		// var grid = $("#"+gridName).data("kendoGrid");
		// grid.hideColumn(0);
  
		// $("#"+gridName).kendoTooltip({  
		//   show: function(e){  
		// 	  if(this.content.text().length > 10){  
		// 	  this.content.parent().css("visibility", "visible");  
		// 	  }  
		//   },  
		//   hide:function(e){  
		// 	  this.content.parent().css("visibility", "hidden");  
		//   },  
		//   filter: "td", 
		//   position: "right",  
		//   content: function(e){  
		// 	  var content = e.target[0].innerText;  
		// 	  return content;  
		//   }  
		//   }).data("kendoTooltip");

		console.log(KendoisLoaded, gridName)
	}
	kendoSelectorByClass(selectorName, url, action, title, preSelected = ''){
		$("."+selectorName).kendoDropDownList({
			serverFiltering: true,
			//filter: true,
			dataSource:  new kendo.data.DataSource({
				transport: {
					read: {
						url: url + "?act="+ action,
						dataType: "json"
					}
				},
				schema: {
					total: 'total',
					data: function (data) {
						var addCustomObject = {"id": "", "name": title}
						data = data.result;

						if( data != null){
							var data = [addCustomObject].concat(data);
							data.slice = () => JSON.parse(JSON.stringify(data));
						}else{
							data = {"id": "", "name": title};
							var data = [].concat(data);
							data.slice = () => JSON.parse(JSON.stringify(data));
						}
						return data;
					}
				},
			}),
			// filter: "startswith",
			value: preSelected,
			dataTextField: "name",
			dataValueField: "id"
		});
	}
	kendoSelector(selectorName, url, action, title, preSelected = ''){
		$("#"+selectorName).kendoDropDownList({
			serverFiltering: true,
			//filter: true,
			dataSource:  new kendo.data.DataSource({
				transport: {
					read: {
						url: url + "?act="+ action,
						dataType: "json"
					}
				},
				schema: {
					total: 'total',
					data: function (data) {
						var addCustomObject = {"id": "", "name": title}
						data = data.result;

						if( data != null){
							var data = [addCustomObject].concat(data);
							data.slice = () => JSON.parse(JSON.stringify(data));
						}else{
							data = {"id": "", "name": title};
							var data = [].concat(data);
							data.slice = () => JSON.parse(JSON.stringify(data));
						}
						return data;
					}
				},
			}),
			// filter: "startswith",
			value: preSelected,
			dataTextField: "name",
			dataValueField: "id"
		});
	}

	kendoMultiSelector(selectorName, url, action, title){
		$("#"+selectorName).kendoMultiSelect({
			
			placeholder: title,
			dataTextField: "name",
			dataValueField: "id",
			headerTemplate: '<div class="dropdown-header k-widget k-header">' +
					'<span></span>' +
					'<span></span>' +
				'</div>',
			footerTemplate: '',
			itemTemplate: '<span class="k-state-default" style="font-size: 13px">#: data.name #</span>',
			tagTemplate:  '<span>#:data.name#</span>',
			dataSource: new kendo.data.DataSource({
				transport: {
					read: {
						dataType: "json",
						url: url +"?act=" + action,
					}
				},
				schema: {
					data: (res) => {
						res = res.result;
						res.slice = () => JSON.parse(JSON.stringify(res));
						return res;
					}
				}
			}),
			height: 300
		});
	}

}

