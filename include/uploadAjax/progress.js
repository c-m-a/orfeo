/**
 *	File Upload Progress JavaScript Class version 0.1
 *	Copyright (C) 2010 Hoppinger BV
 *	www.hoppinger.com
 *
 *	This program is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU Lesser General Public License as published by
 *	the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version. See <http://www.gnu.org/licenses/>.
**/



/**
 * 
 * uploadProgress class which add's a progress bar to file uploads
 * The contents of $_FILES ends JSON'ed in $_POST with same name as original type=file
 * 
 * @author Korstiaan de Ridder korstiaan@hoppinger.com
 * @version 27-05-2010 0.1
**/

var uploadProgress = new Class({

	Implements: [Options],
	options: 
	{
		i_interval : 1000,
		s_actionHelper : 'progress.php',
		messages: 	
			{
				upload_limit_reached : 'Upload size limit reached'
			}
	},

	s_uniqueId : '',
	o_form : {},
	a_inputs : [],
	s_action : '',
	s_target : '',
	o_elements : {},
	initialize : function(o_form,o_options)
	{
		this.setOptions(o_options);

		this.o_form = o_form;

		// Save original values of attributes we're gonna change
		this.s_action = o_form.get('action');
		this.s_target = o_form.get('target');


		// Generate a unique id
		this.s_uniqueId = (Math.random()*100000000).toInt();


		// If form doesn't have id set it
		if(!this.o_form.get('id'))
		{
			this.o_form.set('id','i' + this.s_uniqueId);
		}

		// And finally make sure a submit goes through this class
		o_form.addEvent('submit',this.handleSubmit.bind(this));

	},
	initializeInputs : function()
	{
		this.o_form.getElements('input[type=file]').each((function(o_input)
			{
				if(!o_input.isHidden() && o_input.value != '')
				{
					this.a_inputs.include(o_input);
				}
			}).bind(this));
	},
	hideInputs : function()
	{	
		this.a_inputs.each(function(o_input)
		{
			// Arrays in names are evil, so escape them and save the original
			o_input.origName = o_input.get('name');
			o_input.set('name',escape(o_input.get('name')));
			o_input.setStyle('display','none');
		});
	},
	showInputs : function()
	{
		this.a_inputs.each(function(o_input)
		{	
			o_input.set('name',o_input.origName);
			o_input.setStyle('display','block');
		});
	},
	disableButtons : function()
	{
		this.changeButtonsStatus(true);
	},
	enableButtons : function()
	{
		this.changeButtonsStatus(false);
	},
	changeButtonsStatus : function(s_type)
	{
		this.o_form.getElements('input[type=submit]').each((function(o_submit)
		{
			o_submit.set('disabled',s_type);

		}).bind(this));
	},
	handleSubmit : function()
	{
		this.initializeInputs();

		// Only do something when there are visible input type = file
		if(this.a_inputs.length > 0)
		{

			// Initialize the iframe to post to
			var s_targetIframeId = this.o_form.get('id') + '_iframe';
			this.o_elements.o_targetIframe = new IFrame({'id': s_targetIframeId,'name':s_targetIframeId,'styles': {'display': 'none'}}).inject(this.o_form,'after');


			// Initialize the hidden input field with the upload progress id. Should be on top of the input list!
			this.o_elements.o_apcInput = new Element('input',{'type': 'hidden','name':'APC_UPLOAD_PROGRESS','value':this.s_uniqueId}).inject(this.o_form,'top');

			// Set the temporary action and target

			this.o_form.set('action',this.options.s_actionHelper);
			this.o_form.set('target',this.o_elements.o_targetIframe.get('id'));

			// Disable submit buttons
			this.disableButtons();	
			// Initialize the progressbar div
			this.o_elements.o_progressBarContainer = new Element('div',{'class':'progressBarContainer'}).inject(this.a_inputs[0],'after');
			this.o_elements.o_progressBarContainer.o_progressText = new Element('span',{'class' : 'progressText'}).inject(this.o_elements.o_progressBarContainer);
			this.o_elements.o_progressBarContainer.o_progressBar = new Element('div',{'class':'progressBar'}).inject(this.o_elements.o_progressBarContainer);


			// Add some nice fx
			this.o_elements.o_progressBarContainer.o_progressBar.fx = new Fx.Tween(this.o_elements.o_progressBarContainer.o_progressBar);
			this.changeProgress();


			// And hide the input type = file
			this.hideInputs();

			this.i_startTime = (new Date()).getTime();

			// Poll it every i_interval milliseconds
			this.periodical = (this.handleProgressRequest.bind(this)).periodical(this.options.i_interval);
		}
	},
	handleProgressRequest : function()
	{
		// Poll the progress by requesting the below url with the generated unique id (APC_UPLOAD_PROGRESS) as parameter


		new Request.JSON({
				url : this.options.s_actionHelper,
				method : 'get',
				noCache : 'true',
				onSuccess : (function(o_data)
				{			



					// Place the progressbar at the same place as the input of the current file
					this.a_inputs.each((function(o_input)
						{
							var s_name = o_input.get('name');
							if(o_data.name == s_name)
							{
								this.o_elements.o_progressBarContainer.inject(o_input,'after');
							}
						}).bind(this));
					// If an error has been detected on the server, revert everything and do something with the error
					if(o_data.error)
					{
						this.handleError(o_data.error);
						this.revertSubmit();
					}
					else
					{	
						this.changeProgress(o_data);
						if(o_data.done == 1)
						{
							// We're done, so we can finish
							this.postUpload(o_data);
						}
					}
				}).bind(this)
			}).get({'p':this.s_uniqueId});
	},
	handleError : function(i_error)
	{

		if(i_error == 1)
		{
			alert(this.options.messages.upload_limit_reached);
		}


	},
	postUpload : function(o_data)
	{
		// Loop through every input and set json response in hidden input
		this.a_inputs.each((function(o_input)
			{
				var s_name = o_input.get('name');
				var s_value = '';

				if(o_file = o_data.files[s_name])
				{
					s_value = JSON.encode(o_file);
				}


				var o_jsonInput = new Element('input',{'type': 'hidden','name':o_input.origName,'value':s_value}).replaces(o_input);


			}).bind(this));

		// Make form "original" again by purging elements and resetting attributes
		this.revertSubmit();
		this.o_form.submit();
	},
	revertSubmit : function()
	{
		// Clear timer if present
		$clear(this.periodical);

		// Set attributes to original values
		this.o_form.set('target',this.s_target);
		this.o_form.set('action',this.s_action);

		// Purge useless elements
		for(s_element in this.o_elements)
		{
			this.o_elements[s_element].dispose();
		}

		// Show the inputs again
		this.showInputs();

		// And enable the submits
		this.enableButtons();
	},

	changeProgress : function(o_data)
	{
		var f_percentage = 0;
		var i_eta = 0;
		if(o_data && o_data.total && o_data.current)
		{
			var i_curTime = (new Date()).getTime();
			// Calculate percentage and change progressbar
			var i_total = o_data.total;
			var i_current = o_data.current;

			var f_rate = (o_data.current / ((i_curTime - this.i_startTime) / 1000)); // bytes per seconds
			var i_eta = ((o_data.total - o_data.current) / f_rate).toInt();

			var f_percentage = (i_current / i_total) * 100;
			// Change the progressbars width with some nice fx
		}
		var i_width = ((f_percentage / 100) * this.o_elements.o_progressBarContainer.getStyle('width').toInt()).toInt();
		if(i_width == 0)
		{
			i_width = 1;
		}
		this.o_elements.o_progressBarContainer.o_progressBar.fx.start('width',this.o_elements.o_progressBarContainer.o_progressBar.getStyle('width').toInt(),i_width);
		this.o_elements.o_progressBarContainer.o_progressText.set('text',(f_percentage).toInt() + '%, eta ' + i_eta + 's');
		this.o_elements.o_progressBarContainer.setStyle('display','block');
	}
});
Element.implement({ isHidden: function(){	var w = this.offsetWidth, h = this.offsetHeight,  force = (this.tagName === 'TR');    return (w===0 && h===0 && !force) ? true : (w!==0 && h!==0 && !force) ? false : this.getStyle('display') === 'none';  },  isVisible: function(){    return !this.isHidden();  }});
