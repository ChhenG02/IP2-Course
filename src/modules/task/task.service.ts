import { BadRequestException, Injectable, NotFoundException } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Repository } from 'typeorm';
import { Task } from './entity/task.entity';
import { User } from '../user/entity/user.entity';

@Injectable()
export class TaskService {
  constructor(
    @InjectRepository(Task)
    private tasksRepo: Repository<Task>,
      @InjectRepository(User)
    private usersRepo: Repository<User>,
  ) {}

  create(taskData: Partial<Task>) {
    const task = this.tasksRepo.create(taskData);
    return this.tasksRepo.save(task);
  }

  findAll() {
    return this.tasksRepo.find({
      select: ['id', 'name', 'description', 'completedAt'],
      relations: ['user'],
    });
  }

  async findOne(id: number) {
    const task = await this.tasksRepo.findOne({
      where: { id },
      select: ['id', 'name', 'description', 'completedAt'],
      relations: ['user'],
    });
    if (!task) {
      throw new NotFoundException(`Task with id ${id} not found`);
    }
    if (
      !task.user ||
      !(await this.usersRepo.findOne({ where: { id: task.user.id } }))
    ) {
      throw new BadRequestException(
        `User for task with id ${id} is invalid or does not exist`,
      );
    }
    return task;
  }
  async update(id: number, updateData: Partial<Task>) {
    await this.tasksRepo.update(id, updateData);
    return this.findOne(id);
  }

  remove(id: number) {
    return this.tasksRepo.delete(id);
  }
}
