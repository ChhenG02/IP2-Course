// src/modules/booking/booking.resolver.ts
import { Args, Mutation, Query, Resolver } from '@nestjs/graphql';
import { BookingService, Booking } from './booking.service';

@Resolver('Booking')
export class BookingResolver {
  constructor(private readonly bookingService: BookingService) {}

  @Query('bookings')
  getBookings(
    @Args('startDate') startDate: string,
    @Args('endDate') endDate: string,
  ) {
    return this.bookingService.findAll(startDate, endDate);
  }

  @Mutation('bookHotel')
  bookHotel(
    @Args('hotel_id') hotel_id: number,
    @Args('start_date') start_date: string,
    @Args('end_date') end_date: string,
    @Args('price') price: number,
  ) {
    return this.bookingService.create(hotel_id, start_date, end_date, price);
  }

  @Mutation('cancelBooking')
  cancelBooking(@Args('id') id: number) {
    return this.bookingService.cancel(id);
  }

  @Mutation('checkIn')
  checkIn(@Args('id') id: number) {
    return this.bookingService.checkIn(id);
  }
}