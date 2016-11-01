(function( factory ) {
	if ( typeof define === "function" && define.amd ) {
		define( ["jquery", "../jquery.validate"], factory );
	} else {
		factory( jQuery );
	}
}(function( $ ) {

/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: RU (Russian; ������� ����)
 */
$.extend($.validator.messages, {
	required: "��� ���� ���������� ���������.",
	remote: "����������, ������� ���������� ��������.",
	email: "����������, ������� ���������� ����� ����������� �����.",
	url: "����������, ������� ���������� URL.",
	date: "����������, ������� ���������� ����.",
	dateISO: "����������, ������� ���������� ���� � ������� ISO.",
	number: "����������, ������� �����.",
	digits: "����������, ������� ������ �����.",
	creditcard: "����������, ������� ���������� ����� ��������� �����.",
	equalTo: "����������, ������� ����� �� �������� ��� ���.",
	extension: "����������, �������� ���� � ���������� �����������.",
	maxlength: $.validator.format("����������, ������� �� ������ {0} ��������."),
	minlength: $.validator.format("����������, ������� �� ������ {0} ��������."),
	rangelength: $.validator.format("����������, ������� �������� ������ �� {0} �� {1} ��������."),
	range: $.validator.format("����������, ������� ����� �� {0} �� {1}."),
	max: $.validator.format("����������, ������� �����, ������� ��� ������{0}."),
	min: $.validator.format("����������, ������� �����, ������� ��� ������ {0}.")
});

}));