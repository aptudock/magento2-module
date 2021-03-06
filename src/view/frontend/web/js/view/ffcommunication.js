define(['Magento_Customer/js/customer-data'], function (customerData) {
    'use strict';

    return function (config, element) {
        var sessionData = customerData.get('ffcommunication');
        sessionData.subscribe(function (data) {
            if (data.sid && data.sid !== element.sid) element.sid = data.sid;
            if (data.uid && data.uid !== element.userId) element.userId = data.uid;
        });
        sessionData.valueHasMutated();
    };
});
