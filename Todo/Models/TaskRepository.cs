using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.InteropServices.ComTypes;
using System.Threading.Tasks;

namespace Todo.Models
{
    public class TaskRepository : ITaskRepository
    {
        private readonly AppDbContext _context;

        public TaskRepository(AppDbContext context)
        {
            _context = context;
        }

        public Task Add(Task task)
        {
            _context.Tasks.Add(task);
            _context.SaveChanges();
            return task;

        }

        public void Delete(int id)
        {
            Task task = _context.Tasks.Find(id);
            if (task != null)
            {
                _context.Remove(task);
                _context.SaveChanges();
            }
        }

        public IEnumerable<Task> GetAllTask()
        {
            return _context.Tasks;
        }

        public Task GetTask(int Id)
        {
            return _context.Tasks.Find(Id);
        }

        public Task Update(Task taskChanges)
        {
            var task = _context.Tasks.Attach(taskChanges);
            task.State = Microsoft.EntityFrameworkCore.EntityState.Modified;
            _context.SaveChanges();
            return taskChanges;
        }
    }
}
