Quote = function() {
    this.init();
};

$.extend(Quote.prototype, {
    options: null,
    defaults :{
        addRowSelector: '.js-add-row',
        delRowSelector: '.js-del-row',
        itemWrapSelector: '.js-items-wrap',
        itemSelector: '.js-item'

    },
    boards: [],
    init: function(overrideOptions) {
        console.info('Hello Quote')
        this.options = $.extend({}, this.defaults, overrideOptions);
        this.addEvents();
    },
    cloneRowAction: function($el) {
        var self = this;

        var $wrapper = $el.closest(self.options.itemWrapSelector);
        var item = $wrapper.find(self.options.itemSelector)[0];
        var $item = $(item);
        var regex = /quote\[item_group\]\[([0-9+])\]\[([0-9+])\]\[([A-z]+)\]$/;
        var lastEl = $wrapper.find(self.options.itemSelector).last().find('.js-cloneable')[0];

        var matches = regex.exec(lastEl.name);
        var lastPos = parseInt(matches[2]);

        var $clonedItem = $item.clone(true)
            .find('.js-cloneable')
            .each(function(){
                this.name = this.name.replace(regex,
                function(str, p1, p2, p3) {


                    //console.log(matches);
                    return 'quote[item_group][' + p1 + '][' + (lastPos + 1) + '][' + p3 + ']';
                });


                this.value = '';
                this.selectedIndex = 0;
            }).end().appendTo($wrapper);
        
    },
    removeRowAction: function($el) {
        var self = this;

        if(!self.isLast($el)) {
            $el.closest(self.options.itemSelector).remove();
        }

    },
    isLast: function($el) {
        var self = this;

        return $el.closest(self.options.itemWrapSelector).find(self.options.itemSelector).length == 1
    },
    showError: function(code) {
        console.error(code);
    },
    addEvents: function() {
        var self = this;

        $(document).on('click', this.options.addRowSelector, function(ev) {
            self.cloneRowAction($(this));
        });

        // Calendar Navigation
        $(document).on('click', this.options.delRowSelector, function(ev) {
            self.removeRowAction($(this));
        });

    },
});

var Quote = new Quote();