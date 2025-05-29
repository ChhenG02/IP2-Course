import {
  Body,
  Controller,
  Delete,
  Get,
  Param,
  Post,
  Put,
  UsePipes,
  ValidationPipe,
} from '@nestjs/common';
import { Task } from './entity/task.entity';
import { TaskService } from './task.service';
import { CreateTaskDto } from './dto/create-task.dto';

@Controller('tasks')
export class TasksController {
  constructor(private readonly taskService: TaskService) {}

@Post('create')
@UsePipes(new ValidationPipe({ whitelist: true }))
create(@Body() createTaskDto: CreateTaskDto) {
  return this.taskService.create(createTaskDto);
}

  @Get()
  findAll() {
    return this.taskService.findAll();
  }

  @Get(':id')
  findOne(@Param('id') id: string) {
    return this.taskService.findOne(+id);
  }

  @Put(':id')
  update(@Param('id') id: string, @Body() updateData: Partial<Task>) {
    return this.taskService.update(+id, updateData);
  }

  @Delete(':id')
  remove(@Param('id') id: string) {
    return this.taskService.remove(+id);
  }
}