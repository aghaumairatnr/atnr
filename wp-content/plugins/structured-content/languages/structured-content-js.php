<?php
/**
 * Created by PhpStorm.
 * User: antonioleutsch
 * Date: 23.02.20
 * Time: 15:42
 */

$strings =
	'tinyMCE.addI18n( 
		"' . $mce_locale . '.wpsc", 
		{
	
			faqButtonText : "' . esc_js( __( 'Single FAQ', 'structured-content' ) ) . '",
			
			faqTooltip : "' . esc_js( __( 'Adds a FAQ block to the page.', 'structured-content' ) ) . '",
			
			multiFaqButtonText : "' . esc_js( __( 'Multi FAQ', 'structured-content' ) ) . '",
			
			multiFaqTooltip : "' . esc_js( __( 'Adds multiple FAQ blocks to the page.', 'structured-content' ) ) . '",
			
			faqTitle : "' . esc_js( __( 'Featured Snippet FAQ', 'structured-content' ) ) . '",
			
			jobButtonText : "' . esc_js( __( 'Job', 'structured-content' ) ) . '",
			
			jobTooltip : "' . esc_js( __( 'Adds a Job Posting block to the page.', 'structured-content' ) ) . '",
			
			jobPopupTitle : "' . esc_js( __( 'Featured Snippet Job', 'structured-content' ) ) . '",
			
			eventButtonText : "' . esc_js( __( 'Event', 'structured-content' ) ) . '",
			
			eventTooltip : "' . esc_js( __( 'Adds a Event block to the page.', 'structured-content' ) ) . '",
			
			eventPopupTitle : "' . esc_js( __( 'Featured Snippet Event', 'structured-content' ) ) . '",
			
			personButtonText : "' . esc_js( __( 'Person', 'structured-content' ) ) . '",
			
			personTooltip : "' . esc_js( __( 'Adds a Person block to the page.', 'structured-content' ) ) . '",
			
			personPopupTitle : "' . esc_js( __( 'Featured Snippet Person', 'structured-content' ) ) . '",
			
			courseButtonText : "' . esc_js( __( 'Course', 'structured-content' ) ) . '",
			
			courseTooltip : "' . esc_js( __( 'Adds a Course block to the page.', 'structured-content' ) ) . '",
			
			coursePopupTitle : "' . esc_js( __( 'Featured Snippet Course', 'structured-content' ) ) . '",
			
			renderHTML : "' . esc_js( __( 'Render HTML', 'structured-content' ) ) . '",
			
			titleTag : "' . esc_js( __( 'Title Tag', 'structured-content' ) ) . '",
			
			question : "' . esc_js( __( 'Question', 'structured-content' ) ) . '",
			
			questionPlaceholder : "' . esc_js( __( 'Enter Your Question here...', 'structured-content' ) ) . '",
			
			answer : "' . esc_js( __( 'Answer', 'structured-content' ) ) . '",
			
			answerPlaceholder : "' . esc_js( __( 'Enter your answer here...', 'structured-content' ) ) . '",
			
			job : "' . esc_js( __( 'Job title', 'structured-content' ) ) . '",
			
			jobPlaceholder : "' . esc_js( __( 'Please enter your job title here ...', 'structured-content' ) ) . '",
			
			description : "' . esc_js( __( 'Description', 'structured-content' ) ) . '",
			
			jobDescriptionPlaceholder : "' . esc_js( __( 'Enter your job description here...', 'structured-content' ) ) . '",
			
			event : "' . esc_js( __( 'Event title', 'structured-content' ) ) . '",
			
			eventPlaceholder : "' . esc_js( __( 'Please enter your event title here ...', 'structured-content' ) ) . '",
			
			eventDescriptionPlaceholder : "' . esc_js( __( 'Enter your event description here...', 'structured-content' ) ) . '",
			
			eventMeta : "' . esc_js( __( 'Event Meta', 'structured-content' ) ) . '",
			
			eventLocationNamePlaceholder : "' . esc_js( __( 'Event Location name', 'structured-content' ) ) . '",
			
			eventLocation : "' . esc_js( __( 'Event Location', 'structured-content' ) ) . '",
			
			performer : "' . esc_js( __( 'Performer', 'structured-content' ) ) . '",
			
			type : "' . esc_js( __( 'Type', 'structured-content' ) ) . '",
			
			performingGroup : "' . esc_js( __( 'Performing Group', 'structured-content' ) ) . '",
			
			performingPerson : "' . esc_js( __( 'Person', 'structured-content' ) ) . '",
			
			performerName : "' . esc_js( __( 'Performer', 'structured-content' ) ) . '",
			
			performerNamePlaceholder : "' . esc_js( __( 'John Doe', 'structured-content' ) ) . '",
			
			availability : "' . esc_js( __( 'Offer', 'structured-content' ) ) . '",
			
			offer : "' . esc_js( __( 'Offer', 'structured-content' ) ) . '",
			
			availability : "' . esc_js( __( 'Availability', 'structured-content' ) ) . '",
			
			inStock : "' . esc_js( __( 'In Stock', 'structured-content' ) ) . '",
			
			soldOut : "' . esc_js( __( 'Sold Out', 'structured-content' ) ) . '",
			
			preOrder : "' . esc_js( __( 'Pre Order', 'structured-content' ) ) . '",
			
			ticketWebsite : "' . esc_js( __( 'Ticket Website', 'structured-content' ) ) . '",
			
			ticketWebsitePlaceholder : "' . esc_js( __( 'https://your-website.com', 'structured-content' ) ) . '",
			
			price : "' . esc_js( __( 'Price', 'structured-content' ) ) . '",
			
			altNamePlaceholder : "' . esc_js( __( 'Alternate Name...', 'structured-content' ) ) . '",
			
			namePlaceholder : "' . esc_js( __( 'Please enter your Name', 'structured-content' ) ) . '",
			
			jobTitle : "' . esc_js( __( 'Job Title', 'structured-content' ) ) . '",
			
			jobTitlePlaceholder : "' . esc_js( __( 'Please enter your job title here ...', 'structured-content' ) ) . '",
			
			contactEmail : "' . esc_js( __( 'E-Mail', 'structured-content' ) ) . '",
			
			contactEmailPlaceholder : "' . esc_js( __( 'jane-doe@xyz.edu', 'structured-content' ) ) . '",
			
			contactHomepage : "' . esc_js( __( 'URL', 'structured-content' ) ) . '",
			
			contactHomepagePlaceholder : "' . esc_js( __( 'http://www.janedoe.com', 'structured-content' ) ) . '",
			
			birthdate : "' . esc_js( __( 'Birthdate', 'structured-content' ) ) . '",
			
			image : "' . esc_js( __( 'Image', 'structured-content' ) ) . '",
			
			addImage : "' . esc_js( __( 'Add Image', 'structured-content' ) ) . '",
			
			imageDescription : "' . esc_js( __( 'Image Description', 'structured-content' ) ) . '",
			
			cssClass : "' . esc_js( __( 'CSS class', 'structured-content' ) ) . '",
			
			cssClassPlaceholder : "' . esc_js( __( 'additional css classes ...', 'structured-content' ) ) . '",
			
			company : "' . esc_js( __( 'Company', 'structured-content' ) ) . '",
			
			name : "' . esc_js( __( 'Name', 'structured-content' ) ) . '",
			
			altName : "' . esc_js( __( 'Alternate Name', 'structured-content' ) ) . '",
			
			companyName : "' . esc_js( __( 'Company Name', 'structured-content' ) ) . '",
			
			companyNamePlaceholder : "' . esc_js( __( 'Enter the name of the company', 'structured-content' ) ) . '",
			
			sameAsHeadline : "' . esc_js( __( 'Same as', 'structured-content' ) ) . '",
			
			sameAsLabel : "' . esc_js( __( 'Website / Social Media', 'structured-content' ) ) . '",
			
			sameAs : "' . esc_js( __( 'Same as (Website / Social Media)', 'structured-content' ) ) . '",
			
			sameAsPlaceholder : "' . esc_js( __( 'https://your-website.com', 'structured-content' ) ) . '",
			
			jobLocation : "' . esc_js( __( 'Job Location', 'structured-content' ) ) . '",
			
			contactPhone : "' . esc_js( __( 'Telephone', 'structured-content' ) ) . '",
			
			contactPhonePlaceholder : "' . esc_js( __( '(425) 123-4567', 'structured-content' ) ) . '",
			
			street : "' . esc_js( __( 'Street', 'structured-content' ) ) . '",
			
			streetPlaceholder : "' . esc_js( __( 'Any Street 3A', 'structured-content' ) ) . '",
			
			zip : "' . esc_js( __( 'Postal Code', 'structured-content' ) ) . '",
			
			zipPlaceholder : "' . esc_js( __( 'Any Postal Code', 'structured-content' ) ) . '",
			
			locality : "' . esc_js( __( 'Locality', 'structured-content' ) ) . '",
			
			localityPlaceholder : "' . esc_js( __( 'Any City', 'structured-content' ) ) . '",
			
			countryCode : "' . esc_js( __( 'Country ISO Code', 'structured-content' ) ) . '",
			
			countryCodePlaceholder : "' . esc_js( __( 'US', 'structured-content' ) ) . '",
			
			regionCode : "' . esc_js( __( 'Region ISO Code', 'structured-content' ) ) . '",
			
			regionCodePlaceholder : "' . esc_js( __( 'CA', 'structured-content' ) ) . '",
			
			currencyCode : "' . esc_js( __( 'Currency ISO Code', 'structured-content' ) ) . '",
			
			currencyCodePlaceholder : "' . esc_js( __( 'USD', 'structured-content' ) ) . '",
			
			value : "' . esc_js( __( 'Value', 'structured-content' ) ) . '",
			
			jobMeta : "' . esc_js( __( 'Job Meta', 'structured-content' ) ) . '",
			
			salary : "' . esc_js( __( 'Salary', 'structured-content' ) ) . '",
			
			unit : "' . esc_js( __( 'Unit', 'structured-content' ) ) . '",
			
			hourly : "' . esc_js( __( 'Hourly', 'structured-content' ) ) . '",
			
			daily : "' . esc_js( __( 'Daily', 'structured-content' ) ) . '",
			
			weekly : "' . esc_js( __( 'Weekly', 'structured-content' ) ) . '",
			
			monthly : "' . esc_js( __( 'Monthly', 'structured-content' ) ) . '",
			
			yearly : "' . esc_js( __( 'Yearly', 'structured-content' ) ) . '",
			
			employmentType : "' . esc_js( __( 'Employment Type', 'structured-content' ) ) . '",
			
			fullTime : "' . esc_js( __( 'Full Time', 'structured-content' ) ) . '",
			
			partTime : "' . esc_js( __( 'Part Time', 'structured-content' ) ) . '",
			
			contractor : "' . esc_js( __( 'Contractor', 'structured-content' ) ) . '",
			
			temporary : "' . esc_js( __( 'Temporary', 'structured-content' ) ) . '",
			
			intern : "' . esc_js( __( 'Intern', 'structured-content' ) ) . '",
			
			volunteer : "' . esc_js( __( 'Volunteer', 'structured-content' ) ) . '",
			
			perDiem : "' . esc_js( __( 'Per Diem', 'structured-content' ) ) . '",
			
			other : "' . esc_js( __( 'Other', 'structured-content' ) ) . '",
			
			personal : "' . esc_js( __( 'Personal', 'structured-content' ) ) . '",
			
			contact : "' . esc_js( __( 'Contact', 'structured-content' ) ) . '",
			
			address : "' . esc_js( __( 'Address', 'structured-content' ) ) . '",
			
			colleagues : "' . esc_js( __( 'Colleagues', 'structured-content' ) ) . '",
			
			colleagueLabel : "' . esc_js( __( 'Colleague', 'structured-content' ) ) . '",
			
			colleaguePlaceholder : "' . esc_js( __( 'Comma seperated URLs', 'structured-content' ) ) . '",
			
			course : "' . esc_js( __( 'Course Name', 'structured-content' ) ) . '",
			
			coursePlaceholder : "' . esc_js( __( 'Enter your Course Name here...', 'structured-content' ) ) . '",
			
			courseDescriptionPlaceholder : "' . esc_js( __( 'Enter your Course Description here...', 'structured-content' ) ) . '",
			
			providerInformation : "' . esc_js( __( 'Provider Information', 'structured-content' ) ) . '",
			
			providerName : "' . esc_js( __( 'Provider Name', 'structured-content' ) ) . '",
			
			validThrough : "' . esc_js( __( 'Valid Through', 'structured-content' ) ) . '",
			
			validFrom : "' . esc_js( __( 'Valid From', 'structured-content' ) ) . '",
			
			additional : "' . esc_js( __( 'Additional', 'structured-content' ) ) . '",
			
			addOne : "' . esc_js( __( 'Add One', 'structured-content' ) ) . '",
			
			removeLastOne : "' . esc_js( __( 'Remove Last One', 'structured-content' ) ) . '",
			
			work : "' . esc_js( __( 'Work', 'structured-content' ) ) . '",
			
			works_for_name : "' . esc_js( __( 'Organisation Name', 'structured-content' ) ) . '",
			
			works_for_namePlaceholder : "' . esc_js( __( 'Your Works Name', 'structured-content' ) ) . '",
			
			works_for_alt : "' . esc_js( __( 'Alternate Name', 'structured-content' ) ) . '",
			
			works_for_altPlaceholder : "' . esc_js( __( 'Your Works Alternate Name', 'structured-content' ) ) . '",
			
			works_for_url : "' . esc_js( __( 'Url', 'structured-content' ) ) . '",
			
			works_for_urlPlaceholder : "' . esc_js( __( 'Organisation Website', 'structured-content' ) ) . '",
			
			works_for_logo : "' . esc_js( __( 'Logo', 'structured-content' ) ) . '",
			
			works_for_logoPlaceholder : "' . esc_js( __( 'Organisation Logo', 'structured-content' ) ) . '",
			
			eventStatus : "' . esc_js( __( 'Event Status', 'structured-content' ) ) . '",
			
			startDate : "' . esc_js( __( 'Start Date', 'structured-content' ) ) . '",
			
			endDate : "' . esc_js( __( 'End Date', 'structured-content' ) ) . '",
			
			eventScheduled : "' . esc_js( __( 'Scheduled', 'structured-content' ) ) . '",
			
			eventCancelled : "' . esc_js( __( 'Cancelled', 'structured-content' ) ) . '",
			
			eventMovedOnline : "' . esc_js( __( 'Moved Online', 'structured-content' ) ) . '",
			
			eventPostponed : "' . esc_js( __( 'Postponed', 'structured-content' ) ) . '",
			
			eventRescheduled : "' . esc_js( __( 'Rescheduled', 'structured-content' ) ) . '",
				
			prev_start_date : "' . esc_js( __( 'Previous Start Date', 'structured-content' ) ) . '",
				
			prev_start_datePlaceholder : "' . esc_js( __( 'optional', 'structured-content' ) ) . '",
				
			event_attendance_mode : "' . esc_js( __( 'Attendance Mode', 'structured-content' ) ) . '",
				
			offlineEventAttendanceMode: "' . esc_js( __( 'Offline', 'structured-content' ) ) . '",
			
			onlineEventAttendanceMode: "' . esc_js( __( 'Online', 'structured-content' ) ) . '",
			
			mixedEventAttendanceMode: "' . esc_js( __( 'Mixed', 'structured-content' ) ) . '",
			
			online_url: "' . esc_js( __( 'URL', 'structured-content' ) ) . '",
			
			online_urlPlaceholder: "' . esc_js( __( 'Online URL of Event', 'structured-content' ) ) . '",
		} 
    );
';
