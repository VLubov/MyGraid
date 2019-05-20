define(['jquery'], function($){
    var CustomWidget = function () {
        var self = this;
        this.callbacks = {
            render: function(){
                console.log('render');
                return true;
            },
            init: function(){
                console.log('init');
                return true;
            },
            bind_actions: function(){
                console.log('bind_actions');
                return true;
            },
            settings: function(){
                return true;
            },
            onSave: function(){
                alert('success');
                return true;
            },
            destroy: function(){
                
            },
            contacts: {
                    //select contacts in list and clicked on widget name
                    selected: function(){
                        console.log('contacts');
                    }
                },
            leads: {
                    //select leads in list and clicked on widget name
                    selected: function(){
                        console.log('leads');
                        let c_data = self.list_selected().selected;
                        c_data = JSON.stringify(c_data);
                        console.log(c_data);
                    $.ajax({
                      url: 'http://127.0.0.1/mygraid/index.php',
                      type: "POST",
                      data: {data: c_data},
                        });
                    }
            },
            tasks: {
                    //select taks in list and clicked on widget name
                    selected: function(){
                        console.log('tasks');
                    }
                }
        };
        return this;
    };

return CustomWidget;
});