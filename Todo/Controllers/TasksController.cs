using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Todo.Models;
using Todo.ViewModels;

namespace Todo.Controllers
{
    [Authorize]
    public class TasksController : Controller
    {
        readonly ITaskRepository _taskRepository;

        public TasksController(ITaskRepository taskRepository)
        {
            _taskRepository = taskRepository;
        }
        
        [AllowAnonymous]
        public ViewResult Index()
        {
            var model = _taskRepository.GetAllTask();

            return View(model);
        }

        [HttpGet]
        public ViewResult Create()
        {
            return View();
        }

        [HttpPost]
        public IActionResult Create(CreateTaskViewModel model)
        {
            if (ModelState.IsValid)
            {
                Models.Task newTask = new Models.Task
                {
                    Title = model.Title,
                    TaskDate = model.TaskDate,
                    IsFinished = false,
                };

                _taskRepository.Add(newTask);

                return RedirectToAction("Index", "Tasks");
            }

            return View();
        }

        [HttpGet]
        public ViewResult Edit(int id)
        {
            Models.Task task = _taskRepository.GetTask(id);

            EditTaskViewModel editTaskViewModel = new EditTaskViewModel()
            {
                Id = task.Id,
                Title = task.Title,
                TaskDate = task.TaskDate,
                IsFinished = task.IsFinished,
           };

            return View(editTaskViewModel);
        }

        [HttpPost]
        public IActionResult Edit(EditTaskViewModel model)
        {
            // Check if the provided data is valid, if not rerender the edit view
            // so the user can correct and resubmit the edit form
            if (ModelState.IsValid)
            {
                // Retrieve the task being edited from the database
                Models.Task task = _taskRepository.GetTask(model.Id);
                // Update the employee object with the data in the model object
                task.Title = model.Title;
                task.TaskDate = model.TaskDate;
                task.IsFinished = model.IsFinished;

                // Call update method on the repository service passing it the
                // task object to update the data in the database table
                Models.Task updatedTask = _taskRepository.Update(task);

                return RedirectToAction("index");
            }

            return View(model);
        }

        public IActionResult Delete(int id)
        {
            _taskRepository.Delete(id);
            return RedirectToAction("index");
        }

        public IActionResult UpdateStatus()
        {
            return RedirectToAction("index");
        }
    }
}
