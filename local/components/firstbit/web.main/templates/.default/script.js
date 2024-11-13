BX.ready(function () {
    let color = 0;
    const componentApp = BX.Vue.create({
        el: '#component_news',
        data: function () {
            return {

                // добавьте данные к примеру:
                example: null,
            };
        },

        methods: {
            // Методы компонента
            LoaderMethod() {
                $(".workarea-content-paddings").css('height', '100%').css('padding', '0')
            },
        },
        // Остальные опции компонента
        template: '#component_news_tpl'
    });
});
$(document).ready(function () {
    $('.news').on('click', function (el) {
        BX.SidePanel.Instance.open('/project/detail/?id=' + el.currentTarget.id,
            {
                animationDuration: 100,
                width: (window.innerWidth * 0.7),
            })
    })
});
$(document).ready(function () {
    $('.carousel_news').on('click', function (el) {
        BX.SidePanel.Instance.open('/project/detail/?id=' + el.currentTarget.id,
            {
                animationDuration: 100,
                width: (window.innerWidth * 0.7),
            })
    })
})