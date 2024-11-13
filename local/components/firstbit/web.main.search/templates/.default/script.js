BX.ready(function () {
    let color = 0;
    const componentApp = BX.Vue.create({
        el: '#component_search',
        data: function () {
            return {
				ajaxUrl: 'firstbit:web.main.search',
                input:'',
				params: [],
				items: [
                ],
				currentDate:'',
				descriptionShow: 1,
				description:''
			}
        },
        watch:{
            input(after, before){
                this.getItemsAjax()
                
            }
        },


        methods: {
            // Методы компонента
            LoaderMethod() {
                $(".workarea-content-paddings").css('height', '100%').css('padding', '0')
            },
            ChangeColors() {
                if (color === 0) {
                    $(':root').css('--backColor', '#FFFFFF').css('--reverseColor', '#434343').css('--newsColor', '#FFFFFF')
                    color = 1
                } else {
                    $(':root').css('--backColor', '#434343').css('--reverseColor', '#FFFFFF').css('--newsColor', '#737373')
                    color = 0
                }
            },

            getItemsAjax: function (params, input) {
				BX.ajax.runComponentAction(this.ajaxUrl, 'getItems', {
					mode: 'class',
					data: {
						params: this.params,
                        input: this.input,
					}
				}).then(
					function (response) {
                        
						if (response.status === 'success' && typeof response.data != 'undefined') {
							this.items = response.data   
                            
                            console.log(response.data)
						}
                        
					}.bind(this),
				);
                
			},
            goToPage(id){
                    BX.SidePanel.Instance.open('/project/detail/?id=' +id, {
                        animationDuration: 100,
                        width: (window.innerWidth * 0.7),
                    }) 
            },

            pullTosearch(tag){
                this.input= tag
            },

        },
        
        mounted() {
            this.getItemsAjax()
            
        },
        
        

        // Остальные опции компонента
        template: '#component_search_tpl'
    });
        
});
