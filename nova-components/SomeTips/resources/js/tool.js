Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'some-tips',
            path: '/some-tips',
            component: require('./components/Tool'),
        },
    ])
})
