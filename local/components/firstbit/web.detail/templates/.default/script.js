BX.ready(function () {
    const componentApp = BX.Vue.create({
        el: '#component_detail',
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
        template: '#component_tpl',
    });
});

$(document).ready(function () {
    $('.author').on('click', function (el) {
        BX.SidePanel.Instance.open('/company/personal/user/' + el.currentTarget.id + '/')
    })
})
