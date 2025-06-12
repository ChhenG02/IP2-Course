// src/modules/booking/booking.module.ts
import { Module } from '@nestjs/common';
import { BookingResolver } from './book.resolver';
import { BookingService } from './booking.service';

@Module({
  providers: [BookingResolver, BookingService],
})
export class BookingModule {}