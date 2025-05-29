import { Injectable, NotFoundException } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Repository } from 'typeorm';
import { User } from './entity/user.entity';

@Injectable()
export class UserService {
  constructor(
    @InjectRepository(User)
    private usersRepo: Repository<User>,
  ) {}

  create(userData: Partial<User>) {
    const user = this.usersRepo.create(userData);
    return this.usersRepo.save(user);
  }

  findAll() {
    return this.usersRepo.find({
      select: ['id', 'username', 'email', 'password'],
      relations: ['tasks'],
    });
  }

   async findOne(id: number) {
    const user = await this.usersRepo.findOne({
      where: { id },
      select: ['id', 'username', 'email', 'password'],
      relations: ['tasks'],
    });
    if (!user) {
      throw new NotFoundException(`User with id ${id} not found`);
    }
    return user;
  }

  async update(id: number, updateData: Partial<User>) {
    await this.usersRepo.update(id, updateData);
    return this.findOne(id);
  }

  remove(id: number) {
    return this.usersRepo.delete(id);
  }
}