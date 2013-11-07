// Get the ul that holds the collection of courses
var collectionHolder = $('ul.courses');

// setup an "add a course" link
var $addCourseLink = $('<a href="#" class="add_course_link">Pridėti universitetą</a>');
var $newLinkLi = $('<li></li>').append($addCourseLink);

jQuery(document).ready(function() {


	var uniList = ['Uni1', 'Uni2', 'B3', 'University of Cambridge'];
		$( '#mentor_registration_mentor_courses_0_university' ).typeahead({
			local: uniList
		});


    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    collectionHolder.data('index', collectionHolder.find(':input').length);

    // add the "add a course" anchor and li to the courses ul
    collectionHolder.append($newLinkLi);

    $addCourseLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new course form (see next code block)
        addCourseForm(collectionHolder, $newLinkLi);
    });
});

function addCourseForm(collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = collectionHolder.data('prototype');

    // get the new index
    var index = collectionHolder.data('index');

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a course" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);

    addCourseFormDeleteLink($newFormLi);
}

function addCourseFormDeleteLink($courseFormLi) {
    var $removeFormA = $('<a href="#" class="remove_course_link">Ištrinti universitetą</a>');
    $courseFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the course form
        $courseFormLi.remove();
    });
}