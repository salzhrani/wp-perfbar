var options = {};
for (var prop in budgets) { // budgets is a global provided by wordpress
	options[prop] = {max : parseInt(budgets[prop], 10)};
}
perfBar.init({budget : options});

