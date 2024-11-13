BX.ready(function () {
    const componentApp = BX.Vue.create({
        el: '#component_like',
        data: function () {
            return {
                ajaxUrl: 'firstbit:web.detail.like',
                likes: 0,
                scrImage: 'https://cdn-icons-png.flaticon.com/128/6052/6052056.png',
            };
        }, 
        mounted: function () { 
            this.getLikesCount();
        },
        methods: {
            getParams: function () { 
                this.params = [ 
                    option = '' 
                ]; 
            }, 
        
            getLikesUserAjax: function (params) { 
                BX.ajax.runComponentAction(this.ajaxUrl, 'getLikesUser', { 
                    mode: 'class', 
                    data: { 
                        params: this.params, 
                    } 
                }).then( 
                    function (response) { 
                        if (response.status === 'success' && typeof response.data != 'undefined') {  
                            this.getLikesCount();
                        } 
                    }.bind(this), 
                ); 
            },

            pushTheButton: function () { 
                this.getParams(); 
                this.getLikesUserAjax(this.params);
            },

            getLikesCount: function(params) {
                BX.ajax.runComponentAction(this.ajaxUrl, 'getLikes', {  
                    mode: 'class',  
                    data: {    
                        params: this.params,
                    }  
                }).then(  
                    function (response) {  
                        if (response.status === 'success') {
                            data = response.data;
                            this.likes = data.COUNT_LIKE;
                            if (data.STATUS === 'like'){
                                this.scrImage = "https://cdn-icons-png.flaticon.com/128/6052/6052036.png";
                            } else{
                                this.scrImage = "https://cdn-icons-png.flaticon.com/128/6052/6052056.png";
                            }
                        } else {
                            console.log("Ошибка при отображении лайка"); 
                        }
                    }.bind(this),
                );  
            },
        },
        // Остальные опции компонента
        template: '#component_like_tpl'
    });
});
