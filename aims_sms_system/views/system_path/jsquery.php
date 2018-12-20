<script type="text/javascript"> 
    
    function getOfferedSessionId() {
        var id = $("#getsessionid").val();
        
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('systemaccess/userquery/getprogramLevellist'); ?>",
          dataType: "html",
          data: "id=" + id,
          beforeSend: function() {
                      //  $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
                  },
                  success: function(msg) {

                    	//alert(msg);
                        $('#getprogramLevelid').empty().append(msg);
                    }
                });

    }
    
    function getClassId() {
        var id = $("#getprogramLevel").val();
        
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('systemaccess/userquery/getClasslist'); ?>",
          dataType: "html",
          data: "id=" + id,
          beforeSend: function() {
                      //  $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
                  },
                  success: function(msg) {
                    
                    $('#getCLAssid').empty().append(msg);
                }
            });

    }

    function getOfferedprogramLevelId() {
        var id = $("#getprogramLevelid").val();
          //alert(id);
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getprogramlist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
                //                        $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
            },
            success: function(msg) {
                //
                //alert(msg);                            $('.add_list').empty();
                $('#getprogramid').empty().append(msg);

            }
        });
          
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getcourselist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
                //                        $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
            },
            success: function(msg) {
                //                            $('.add_list').empty();
                $('#getcourseid').empty().append(msg);

            }
        });
          
          

      }
      
      function getOfferedSession_classId() {
        var id = $("#getsessionid").val();
               //alert(id);
               $.ajax({
                  type: "POST",
                  url: "<?php echo base_url('systemaccess/userquery/getsession_programlist'); ?>",
                  dataType: "html",
                  data: "id=" + id,
                  beforeSend: function() {
                      //  $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
                  },
                  success: function(msg) {
                    //  alert(msg);
                    $('#getprogramid').empty().append(msg);
                }
            });

           }
           function getProgrammOfferId() {
               var id = $("#getsessionidd").val();
               //alert(id);
               $.ajax({
                  type: "POST",
                  url: "<?php echo base_url('systemaccess/userquery/getProgramOfferList'); ?>",
                  dataType: "html",
                  data: "id=" + id,
                  beforeSend: function() {
                  },
                  success: function(msg) {
                    //  alert(msg);
                    $('#getProgramOfferId').empty().append(msg);
                }
            });
           }

           function getOfferedprogramId() {
            var id = $("#getprogramid").val();
            var session = $('#getsessionid').val();
          // alert(id);
        // Get Offered Medium List By Class  
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getoffermediumlist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
            },
            success: function(msg) {
                // 
               // alert(msg);                          // $('.add_list').empty();
               $('#getmediumid').empty().append(msg);
           }
       });
        // Get Offered Group List By Class  
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getoffergrouplist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
            },
            success: function(msg) {
                //                            $('.add_list').empty();
                $('#getgroupid').empty().append(msg);

            }
        });

        // Get Offered Shift List By Class  
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getoffershiftlist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
            },
            success: function(msg) {
                //$('.add_list').empty();
                $('#getshiftid').empty().append(msg);
            }
        });

        // Get Offered Section List By Class  
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getoffersectionlist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
            },
            success: function(msg) {
                //                            $('.add_list').empty();
                $('#getsectionid').empty().append(msg);

            }
        });
        
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getofferemployeelist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
                //                        $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
            },
            success: function(msg) {
                //                            $('.add_list').empty();
                $('#getemployeeid').empty().append(msg);

            }
        });
        
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getofferSubjectlist'); ?>",
            dataType: "html",
            data: {id:id,session:session},
            beforeSend: function() {
                //                        $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
            },
            success: function(msg) {
                //                            $('.add_list').empty();
                $('#getSubjectid').empty().append(msg);

            }
        });

    }
    
    function getOfferedprogramId_Subjectid() {
        var id = $("#getprogramid").val();
          // alert(id);
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getoffermediumlist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
                //                        $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
            },
            success: function(msg) {
                //                            $('.add_list').empty();
                $('#getmediumid').empty().append(msg);

            }
        });
          
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getofferSubjectlist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
                //                        $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
            },
            success: function(msg) {
                //                            $('.add_list').empty();
                $('#getSubjectid').empty().append(msg);

            }
        });

      }

      function getOfferedprogramId_Subjectid_byEMP() {
        var id = $("#getprogramid").val();
        
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getoffermediumlist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
                //                        $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
            },
            success: function(msg) {
                //                            $('.add_list').empty();
                $('#getmediumid').empty().append(msg);

            }
        });
        
        
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('e_teacher/userquery/getOfferedprogramId_Subjectid_byEMP'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
                //                        $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
            },
            success: function(msg) {
                //                            $('.add_list').empty();
                $('#getSubjectid').empty().append(msg);

            }
        });

    }
    
    function getOfferedmediumId() {
        var id = $("#getmediumid").val();
        //alert(id);

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getoffergrouplist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
                //                        $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
            },
            success: function(msg) {
             //   alert();
                //                            $('.add_list').empty();
                $('#getgroupid').empty().append(msg);
                $('#getgroupid').val(' ');
            }
        });

    }


    function get_subjects_name()
    {
        var sessionId = $("#getsessionid").val();
        var programId = $("#getprogramid").val();
        var mediumId = $("#getmediumid").val();
        var shiftId = $("#getshiftid").val();
        var groupId = $("#getgroupid").val();
        var sectionId = $("#getsectionid").val();
        var semesterId = $(".getsemesterid").val();

        if(sessionId && programId && mediumId && shiftId && groupId && sectionId && semesterId)
        {
            var sendData = {groupId:groupId,sessionId:sessionId,programId:programId,mediumId:mediumId,shiftId:shiftId,sectionId:sectionId,semesterId:semesterId};

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('systemaccess/userquery/get_subjects_name'); ?>",
                dataType: "html",
                data: sendData,
                beforeSend: function() {
                },
                success: function(msg) {
                    //console.log(msg);
                    $('#getSubjectid').empty().append(msg);
                }
            });
        }
    }


    function getOfferedgroupId() {
        var id = $("#getgroupid").val();
        // $.ajax({
        //     type: "POST",
        //     url: "<?php echo base_url('systemaccess/userquery/getoffershiftlist'); ?>",
        //     dataType: "html",
        //     data: "id=" + id,
        //     beforeSend: function() {
        //         //                        $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
        //     },
        //     success: function(msg) {
        //         //                            $('.add_list').empty();
        //         $('#getshiftid').empty().append(msg);

        //     }
        // });

        var sessionId = $("#getsessionid").val();
        var programId = $("#getprogramid").val();
        var mediumId = $("#getmediumid").val();
        var shiftId = $("#getshiftid").val();
        var sectionId = $("#getsectionid").val();

        var sendData = {groupId:id,sessionId:sessionId,programId:programId,mediumId:mediumId,shiftId:shiftId,sectionId:sectionId};

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getOfferCourseList'); ?>",
            dataType: "html",
            data: sendData,
            beforeSend: function() {
            },
            success: function(msg) {
                console.log(msg);
                $('#getSubjectid').empty().append(msg);
            }
        });
    }
    
    function getOfferedshiftId() {
        var id = $("#getprogramid").val();
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getoffersectionlist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
                //                        $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
            },
            success: function(msg) {
                //                            $('.add_list').empty();
                $('#getsectionid').empty().append(msg);
                $('#getgroupid').val('');
            }
        });

      }
      
      function getOfferedsectionId() {
        var id = $("#getsectionid").val();
        
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getofferemployeelist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
                //                        $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
            },
            success: function(msg) {
                //                            $('.add_list').empty();
                $('#getemployeeid').empty().append(msg);

            }
        });

    }
    
    function confirmAttendance(valu) {
        var id = valu;
       // alert (id);
       $.ajax({
        type: "POST",
        url: "<?php echo base_url('systemaccess/employee/confirmattendance'); ?>",
        dataType: "html",
        data: "id=" + id,
        beforeSend: function() {
                //                        $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
            },
            success: function(msg) {
                //                            $('.add_list').empty();
               // $('#getemployeeid').empty().append(msg);

           }
       });

   }
   
   
   function getdistrict() {
    var id = $("#getdistrictid").val();
    
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('systemaccess/userquery/getDistlist'); ?>",
      dataType: "html",
      data: "id=" + id,
      beforeSend: function() {
                      //  $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
                  },
                  success: function(msg) {
                    
                    $('#getUpozila').empty().append(msg);
                }
            });

}

function getUpozila() {
    var id = $("#getUpozila").val();
          // alert(id);
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getUpozilalist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
                //                        $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
            },
            success: function(msg) {
                //                            $('.add_list').empty();
                $('#getprogramid').empty().append(msg);

            }
        });
          

      }



      function getOfferedgroupId_for_teacher() {

        if(!$.isNumeric($("#getgroupid").val())) {
            alert("Please select a valid group");
            return false;
        }
        if(!$.isNumeric($("#getsessionid").val())) {
            alert("Please select a valid session");
            return false;
        }
        if(!$.isNumeric($("#getprogramid").val())) {
            alert("Please select a valid class");
            return false;
        }
        if(!$.isNumeric($("#getmediumid").val())) {
            alert("Please select a valid medium");
            return false;
        }
        if(!$.isNumeric($("#getshiftid").val())) {
            alert("Please select a valid shift");
            return false;
        }
        if(!$.isNumeric($("#getsectionid").val())) {
            alert("Please select a valid section");
            return false;
        }
        var id = $("#getgroupid").val();
        var sessionId = $("#getsessionid").val();
        var programId = $("#getprogramid").val();
        var mediumId = $("#getmediumid").val();
        var shiftId = $("#getshiftid").val();
        var sectionId = $("#getsectionid").val();

        var sendData = {groupId:id,sessionId:sessionId,programId:programId,mediumId:mediumId,shiftId:shiftId,sectionId:sectionId};
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getOfferCourseList_for_teacher'); ?>",
            dataType: "html",
            data: sendData,
            beforeSend: function() {
            },
            success: function(msg) {
                console.log(msg);
                $('#getSubjectid').empty().append(msg);
            }
        });
    }


    
    
    function getemployeetype() {
        var id = $("#getemployeeid").val();
        
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('systemaccess/userquery/getDesignation'); ?>",
          dataType: "html",
          data: "id=" + id,
          beforeSend: function() {
                      //  $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
                  },
                  success: function(msg) {
                    
                    $('#getdesignation').empty().append(msg);
                }
            });

    }
    
    function getdesignation() {
        var id = $("#getdesignation").val();
          // alert(id);
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getUpozilalist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
                //                        $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
            },
            success: function(msg) {
                //                            $('.add_list').empty();
                $('#getprogramid').empty().append(msg);

            }
        });
          

      }
      
      
      function getOfferedSession_classIdbyteacher() {
        var id = $("#getsessionid").val();
               //alert(id);
               $.ajax({
                  type: "POST",
                  url: "<?php echo base_url('systemaccess/userquery/getsession_programlistbyteacher'); ?>",
                  dataType: "html",
                  data: "id=" + id,
                  beforeSend: function() {
                      //  $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
                  },
                  success: function(msg) {
                    console.log('mess='+msg);
                   //   alert(msg);
                   $('#getprogramid').empty().append(msg);
                   $('#getgroupid').val(' ');
               }
           });

           }
           
           
           function getOfferedprogramId_Subjectidbyteacher() {
            var id = $("#getprogramid").val();
          // alert(id);
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getoffermediumlist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
            },
            success: function(msg) {
                //                            $('.add_list').empty();
                $('#getmediumid').empty().append(msg);

            }
        });


        //$.ajax({
        //    type: "POST",
        //    url: "<?php //echo base_url('systemaccess/userquery/getofferSubjectlistbyteacher'); ?>//",
        //    dataType: "html",
        //    data: "id=" + id,
        //    beforeSend: function() {
        //        //                        $('.city_list').empty().append("<div><img  style=\"padding-top:10px;padding-left:35px;\" src=\""+site_url_path+"img/pre-load.gif\" title=\"loading..\"></div>");
        //    },
        //    success: function(msg) {
        //         //  alert(msg);
        //           $('.add_list').empty();
        //        $('#getSubjectid').empty().append(msg);
        //
        //    }
        //});


          // Get Offered Group List By Class
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getoffergrouplist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
            },
            success: function(msg) {
                //                            $('.add_list').empty();
                $('#getgroupid').empty().append(msg);

            }
        });

        // Get Offered Shift List By Class
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getoffershiftlist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
            },
            success: function(msg) {
                //                            $('.add_list').empty();
                $('#getshiftid').empty().append(msg);

            }
        });

        // Get Offered Section List By Class
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('systemaccess/userquery/getoffersectionlist'); ?>",
            dataType: "html",
            data: "id=" + id,
            beforeSend: function() {
            },
            success: function(msg) {
                //                            $('.add_list').empty();
                $('#getsectionid').empty().append(msg);

            }
        });

    }
    
</script>
