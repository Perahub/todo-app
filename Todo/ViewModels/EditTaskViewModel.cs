using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace Todo.ViewModels
{
    public class EditTaskViewModel : CreateTaskViewModel
    {
        public int Id { get; set; }
    }
}
