using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace Todo.Models
{
    public interface ITaskRepository
    {
        Task GetTask(int Id);

        IEnumerable<Task> GetAllTask();

        Task Add(Task task);

        Task Update(Task taskChanges);

        void Delete(int id);

    }
}
