var options = {};
var disable = [];
for (var prop in budgets) { // budgets is a global provided by wordpress
	
	if (budgets[prop].max || budgets[prop].min) {
		options[prop] = {};
	}

	if (budgets[prop].max) {
		options[prop].max = parseInt(budgets[prop].max, 10);
	}

	if (budgets[prop].min) {
		options[prop].min = parseInt(budgets[prop].min, 10);
	}

	if (budgets[prop].disable) {
		disable.push(prop);
	}
}

perfBar.init({budget : options});

if (disable.length > 0) {
	for (var i = 0; i < disable.length; i++) {
		perfBar.disabledMetrics[disable[i]] = disable[i];
	}
}

