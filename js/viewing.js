Viewing = function() {
    this.init();
};

$.extend(Viewing.prototype, {
    options: null,
    defaults :{
        viewingModalRequestSelector: '.js-viewing-modal-request',
        viewingModalSelector: '#viewingModal',
        viewingInfoCoupleSelector: '.js-viewing-couple',
        viewingInfoEmailSelector: '.js-viewing-email',
        viewingInfoCreatedSelector: '.js-viewing-created-at',
        viewingCreateSelector: '.js-create-viewing',
        viewingEnquiryIdSelector: '.js-enquiry-id',
        viewingFormSelector: '.js-create-viewing-form'
    },
    boards: [],
    init: function(overrideOptions) {
        console.info('Hello Viewing')
        this.options = $.extend({}, this.defaults, overrideOptions);
        this.addEvents();
    },
    showModalAction: function($el) {
        var self = this;

        var email = $el.closest('tr').data('email');
        $(self.options.viewingInfoCoupleSelector).html($el.closest('tr').data('couple'));
        $(self.options.viewingInfoEmailSelector).html('<a href="mailto:' + email + '">' + email + '</a>');
        $(self.options.viewingInfoCreatedSelector).html($el.closest('tr').data('created-at'));
        $(self.options.viewingEnquiryIdSelector).val($el.closest('tr').data('lead-id'));

        $(self.options.viewingModalSelector).modal('show');
    },
    createViewingAction: function($el) {
        var self = this;
        var leadId = $el.data('lead-id');
        var $frm = $(self.options.viewingFormSelector);

        $.ajax({
            async: true,
            dataType: "json",
            type: $frm.attr('method'),
            url: $frm.attr('action'),
            data: $frm.serialize()
        }).done(function (json) {
            if(json.result == 'OK') {
                self.hideModalAction();
                return true;
            }

            alert('There was a problem whilst trying to add your booking');
        });
    },
    hideModalAction: function() {
        var self = this;
        $(self.options.viewingModalSelector).modal('hide');
    },
    showError: function(code) {
        console.error(code);
    },
    addEvents: function() {
        var self = this;

        $(document).on('click', this.options.viewingModalRequestSelector, function(ev) {
            self.showModalAction($(this));
        });

        // Calendar Navigation
        $(document).on('click', this.options.viewingCreateSelector, function(ev) {
            self.createViewingAction($(this));
        });

    },
});

// example of using the class built above
var Viewing = new Viewing();