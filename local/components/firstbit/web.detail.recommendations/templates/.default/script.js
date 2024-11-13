BX.ready(function () {
    const componentApp = BX.Vue.create({
        el: '#component_recomm',
        data: function () {
            return {

                // добавьте данные к примеру:
                example: null,
            };
        },

        methods: {

            // Методы компонента
        },
        // Остальные опции компонента
        template: '#component_recomm_tpl'
    });
});
$(document).ready(function () {
    $('.news').on('click', function (el) {
        BX.SidePanel.Instance.open('/project/detail/?id=' + el.currentTarget.id,
            {
                animationDuration: 100,
                width: (window.innerWidth),
            })
    })
})