using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Threading.Tasks;

namespace Todo.ViewModels
{
    public class CreateTaskViewModel
    {
        [Required]
        public string Title { get; set; }

        [DisplayFormat(ApplyFormatInEditMode = true, DataFormatString = "{0:MM/dd/yyyy}")]
        [DataType(DataType.Date)]
        [Display(Name = "Task Date")]
        public DateTime TaskDate { get; set; }

        public bool IsFinished { get; set; }

    }
}
