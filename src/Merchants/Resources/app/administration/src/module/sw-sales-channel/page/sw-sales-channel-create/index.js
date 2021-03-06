const { Component } = Shopware;

Component.override('sw-sales-channel-create', {
    computed: {
        landingPageRepository() {
            return this.repositoryFactory.create('sales_channel_landing_page');
        },
    },

    methods: {
        createdComponent() {
            this.$super('createdComponent');

            this.$set(this.salesChannel.extensions, 'landingPage', this.landingPageRepository.create(Shopware.Context.Api));
            this.salesChannel.extensions.landingPage.salesChannelId = this.salesChannel.id;
        },

        onSave() {
            if (!this.salesChannel.extensions.landingPage.cmsPageId) {
                this.createNotificationError({
                    title: this.$tc('sw-sales-channel.detail.titleSaveError'),
                    message: 'Please specify a landingpage layout'
                });

                return;
            }

            this.$super('onSave');
        }
    }
});
