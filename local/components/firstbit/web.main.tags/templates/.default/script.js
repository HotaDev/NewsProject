BX.ready(function () {
    const componentApp = BX.Vue.create({
        el: '#component_tags',
        data: function () {
            return {

                // добавьте данные к примеру:
                example: null,
            };
        },

        methods: {
            // Методы компонента
            LoaderMethod() {
            },
        }
    });
});